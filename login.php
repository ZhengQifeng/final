<?php
$app->get('/', function() use($app){
	$data = array(
    	'mainTitle' => '登录注册',
    	'css' => '/final/src/style/login.css',
    	'js' => array('/final/src/dist/login.js','/final/src/dist/loginbg.js'),
    	'name' => 'zhengqifeng'
    );
   	$app ->render('login.html',$data);
});
$app->post('/addUsers', function() use($app){
	$usersmain 	= DbOper::model('users.main');
	$data       = array(
		'phone'       => $app->request->post('phone', null)
	);
	$member     = array(
		'phone'       => $app->request->post('phone', null),
		'password'	  => $app->request->post('password', ''),
		'customer'    => 0
	);
	$result = $usersmain->findOne($data);
	if(empty($result)) {
		$usersmain->insert($member);
		session_start();
		$_SESSION['user']=$member['phone'];
		DbOper::show(1,'注册成功');
	}else {
		DbOper::show(0,'注册失败，账号已存在');
	}
});
$app->post('/findUsers', function() use($app){
	$usersmain 	= DbOper::model('users.main');
	$password   = $app->request->post('password', 'null');
	$member     = array(
		'phone'       => $app->request->post('phone', null)
	);
	$result = $usersmain->findOne($member);
	if($result['password'] == $password) {
		if($result['customer'] == 0){
			session_start();
			$_SESSION['user']=$member['phone'];
			DbOper::show(1,'普通用户登录成功');
		}
		if($result['customer'] == 1){
			session_start();
			$_SESSION['adminuser']=$result['name'];
			DbOper::show(2,'管理员用户登录成功');
		}
	}else {
		DbOper::show(0,'账号密码错误，登录失败');
	}
});
?>