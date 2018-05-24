<?php
$app->get('/', function() use($app){
	session_start();
	$phone = '';
	if(empty($_SESSION['user'])){
		$app->response->redirect('/final/login', 303);
	}else{
		$result = 1;
		$phone = $_SESSION['user'];
		$usersmain = DbOper::model('users.main');
		$userQuery = array();
		$userQuery['phone'] = $phone;
		$userData = $usersmain -> find($userQuery);
		$ordermain 	= DbOper::model('order.main');
		$query = array();
		$query['user_ident'] = $userData[0]['_id'];
		$findResult = $ordermain -> find($query);
		$partsmain 	= DbOper::model('parts.main');
		$partQuery = array();
		$partData = array();
		for($i = 0; $i < count($findResult); $i++){
			$partQuery['_id'] = new MongoId($findResult[$i]['part_ident']); 
			$partData = $partsmain -> find($partQuery);
			$findResult[$i]['part_name'] = $partData[0]['name'];
		}
		$data = array(
	    	'mainTitle' => '购物车',
	    	'js' => array('/final/src/dist/shopping.js'),
	    	'name' => 'zhengqifeng',
	    	'result' => $result,
	    	'phone' => $phone,
	    	'findResult' => $findResult
	    );
	   	$app ->render('shopping.html',$data);
	}
});
$app->post('/pay', function() use($app){
	if($_POST['data']['order_state'] == 0){
		$ordermain 	= DbOper::model('order.main');
		$data = array();
		$query = array();
		$data['_id'] = new MongoId($_POST['data']['_id']);
		$query['order_state'] = 1;
		$newdata = array('$set' => $query);
		$result = $ordermain->update($data, $newdata);
		$findResult = $ordermain -> find($data);
		DbOper::show(1, '支付成功' ,$findResult[0]);
	}else if($_POST['data']['order_state'] == 1){
		DbOper::show(0, '支付失败，订单已支付');
	}
});
$app->post('/delete', function() use($app){
	$ordermain 	= DbOper::model('order.main');
	$data = array();
	$query = array();
	$data['_id'] = new MongoId($_POST['data']['_id']);
	$findResult = $ordermain -> delete($data);
	DbOper::show(1, '删除成功');
});
?>