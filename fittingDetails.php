<?php
$app->get('/', function() use($app){
	session_start();
	$phone = '';
	$partsmain 	= DbOper::model('parts.main');
	$urlData = $_SERVER["QUERY_STRING"];
	$query = comFun::anayStrQuery($urlData);
	$findResult = $partsmain -> find($query);
	if(empty($_SESSION['user'])){
		$result = 0;
	}else{
		$result = 1;
		$phone = $_SESSION['user'];
	}
	$data = array(
    	'mainTitle' => '配件详情',
    	'js' => array('/final/src/dist/fittingDetails.js'),
    	'name' => 'zhengqifeng',
    	'result' => $result,
    	'phone' => $phone,
    	'partResult' => $findResult
    );
   	$app ->render('fittingDetails.html',$data);
});
$app->post('/add', function() use($app){
	session_start();
	$phone = '';
	if(empty($_SESSION['user'])){
		DbOper::show(0,'请先登录');
	}else{
		$phone = $_SESSION['user'];
		$usersmain = DbOper::model('users.main');
		$seller = (int)$_POST['seller'];
		$postData = $_POST['data'];
		$query = array();
		$userQuery = array();
		$userQuery['phone'] = $phone;
		$userData = $usersmain -> find($userQuery);
		$query['number'] = $seller;
		$query['part_ident'] = $postData['_id'];
		$query['user_ident'] = $userData[0]['_id'];
		$query['order_state'] = 0;
		$query['price'] = $postData['price'];
		$query['start_time'] = intval(time());
		$query['pay_time'] = 10;
		$ordermain 	= DbOper::model('order.main');
		$ordermain -> insert($query);
		DbOper::show(1,'添加成功');
	}
})
?>