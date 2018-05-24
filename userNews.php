<?php
$app->get('/', function() use($app){
	session_start();
	$phone = '';
	$usersmain 	= DbOper::model('users.main');
	if(empty($_SESSION['user'])){
		$app->response->redirect('/final/login', 303);
		$result = 0;
	}else{
		$result = 1;
		$phone = $_SESSION['user'];
	}
	$resultUser = $usersmain->find(array('phone' => $phone));
	$data = array(
    	'mainTitle' => '配件详情',
    	'js' => array('/final/src/dist/userNews.js'),
    	'name' => 'zhengqifeng',
    	'result' => $result,
    	'phone' => $phone,
    	'resultUser' => $resultUser
    );
   	$app ->render('userNews.html',$data);
});

$app->post('/Updata', function() use($app){
	$usersmain 	= DbOper::model('users.main');
	$data = array();
	$data['_id'] = new MongoId($_POST['data']['_id']);
	$query = $_POST['data'];
	$query['customer'] = (int)$query['customer'];
	$query['_id'] = new MongoId($query['_id']);
	$result = $usersmain->update($data, $query);
	$resultUser = $usersmain->find(array('phone' => $_POST['data']['phone']));
	DbOper::show(1,'更新成功',$resultUser);
});
?>