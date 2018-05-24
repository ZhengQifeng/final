<?php
$app->get('/', function() use($app){
	session_start();
	$name = '';
	$src = '';
	$usersmain 	= DbOper::model('users.main');
	if(empty($_SESSION['adminuser'])){
		$result = 0;
		$app->response->redirect('/final/login', 303);
	}else{
		$result = 1;
		$name = $_SESSION['adminuser'];
	}
	$member     = array(
		'name'       => $name
	);
	$result = $usersmain->findOne($member);
	$src = $result['pic_src'];
	$data = array(
    	'mainTitle' => '管理端',
    	'js' => array('/final/src/dist/admin.js'),
    	'name' => 'zhengqifeng',
    	'result' => $result,
    	'name' => $name,
    	'src' => $src
    );
   	$app ->render('admin.html',$data);
});

$app->post('/imgUpload', function() use($app){
	// move_uploaded_file($_FILES["file"]["tmp_name"], "http://localhost/final/src/image/" . $_FILES["file"]["name"]);
    echo $_FILES["file"]["tmp_name"];
});

/*配件总分类*/
$app->post('/classifyAll', function() use($app){
	$classifymain 	= DbOper::model('classify.main');
	$result = $classifymain->findAll();
	DbOper::show(1,'请求成功',$result);
});

/*配件总分类更新*/
$app->post('/classifyAll/Updata', function() use($app){
	$classifymain 	= DbOper::model('classify.main');
	$data = array();
	$data['_id'] = new MongoId($_POST['data']['_id']);
	$query = $_POST['data'];
	$query['_id'] = new MongoId($query['_id']);
	$query['classify_ident'] = (int)$query['classify_ident'];
	$result = $classifymain->update($data, $query);
	DbOper::show(1,'更新成功',$result);
});

/*配件总分类删除*/
$app->post('/classifyAll/Delete', function() use($app){
	$classifymain 	= DbOper::model('classify.main');
	$data['_id'] = new MongoId($_POST['data']['_id']);
	$result = $classifymain->delete($data);
	DbOper::show(1,'删除成功',$result);
});

/*配件总分类添加*/
$app->post('/classifyAll/Insert', function() use($app){
	$classifymain 	= DbOper::model('classify.main');
	$dataRepeat['classify_ident'] = (int)$_POST['data']['classify_ident'];
	$data = $_POST['data'];
	$data['classify_ident'] = (int)$data['classify_ident'];
	$resultRepeat = $classifymain->find($dataRepeat);
	if(empty($resultRepeat)){
		$result = $classifymain->insert($data);
		DbOper::show(1,'添加成功',$result);
	}else{
		DbOper::show(0,'分类号已存在，插入失败');
	}
});

/*配件细分类*/
$app->post('/classifyFine', function() use($app){
	$fittingmain 	= DbOper::model('fitting.main');
	$classifymain 	= DbOper::model('classify.main');
	$result = $fittingmain->findAll();
	for($i = 0 ; $i < count($result); $i++){
		$classifyIdent = $result[$i]['classify_ident'];
		$classifyResult = $classifymain->find(array('classify_ident' => $classifyIdent));
		$result[$i]['classify_name'] = empty($classifyResult) ? '' : $classifyResult[0]['name'];
	}
	DbOper::show(1,'请求成功',$result);
});

/*配件细分类更新*/
$app->post('/classifyFine/Updata', function() use($app){
	$fittingmain 	= DbOper::model('fitting.main');
	$data = array();
	$data['_id'] = new MongoId($_POST['data']['_id']);
	$query = $_POST['data'];
	$query['_id'] = new MongoId($query['_id']);
	$query['fitting_ident'] = (int)$query['fitting_ident'];
	$query['classify_ident'] = (int)$query['classify_ident'];
	$result = $fittingmain->update($data, $query);
	DbOper::show(1,'更新成功',$result);
});

/*配件细分类删除*/
$app->post('/classifyFine/Delete', function() use($app){
	$fittingmain 	= DbOper::model('fitting.main');
	$data['_id'] = new MongoId($_POST['data']['_id']);
	$result = $fittingmain->delete($data);
	DbOper::show(1,'删除成功',$result);
});

/*配件细分类添加*/
$app->post('/classifyFine/Insert', function() use($app){
	$fittingmain 	= DbOper::model('fitting.main');
	$dataRepeat['fitting_ident'] = (int)$_POST['data']['fitting_ident'];
	$data = $_POST['data'];
	$data['classify_ident'] = (int)$data['classify_ident'];
	$data['fitting_ident'] = (int)$data['fitting_ident'];
	$resultRepeat = $fittingmain->find($dataRepeat);
	if(empty($resultRepeat)){
		$result = $fittingmain->insert($data);
		DbOper::show(1,'添加成功',$result);
	}else{
		DbOper::show(0,'分类号已存在，插入失败');
	}
});

/*配件品牌分类*/
$app->post('/classifyBrand', function() use($app){
	$brandmain 	= DbOper::model('brand.main');
	$result = $brandmain->findAll();
	DbOper::show(1,'请求成功',$result);
});

/*配件品牌更新*/
$app->post('/classifyBrand/Updata', function() use($app){
	$brandmain 	= DbOper::model('brand.main');
	$data = array();
	$data['_id'] = new MongoId($_POST['data']['_id']);
	$query = $_POST['data'];
	$query['_id'] = new MongoId($query['_id']);
	$query['brand_ident'] = (int)$query['brand_ident'];
	$result = $brandmain->update($data, $query);
	DbOper::show(1,'更新成功',$result);
});

/*配件品牌删除*/
$app->post('/classifyBrand/Delete', function() use($app){
	$brandmain 	= DbOper::model('brand.main');
	$data['_id'] = new MongoId($_POST['data']['_id']);
	$result = $brandmain->delete($data);
	DbOper::show(1,'删除成功',$result);
});

/*配件品牌添加*/
$app->post('/classifyBrand/Insert', function() use($app){
	$brandmain 	= DbOper::model('brand.main');
	$dataRepeat['brand_ident'] = (int)$_POST['data']['brand_ident'];
	$data = $_POST['data'];
	$data['brand_ident'] = (int)$data['brand_ident'];
	$resultRepeat = $brandmain->find($dataRepeat);
	if(empty($resultRepeat)){
		$result = $brandmain->insert($data);
		DbOper::show(1,'添加成功成功',$result);
	}else{
		DbOper::show(0,'分类号已存在，插入失败');
	}
});

/*配件详情*/
$app->post('/part', function() use($app){
	$partsmain 	= DbOper::model('parts.main');
	$brandmain 	= DbOper::model('brand.main');
	$fittingmain 	= DbOper::model('fitting.main');
	$result = $partsmain->findAll();
	for($i = 0 ; $i < count($result); $i++){
		$brandIdent = $result[$i]['brand_ident'];
		$fittingIdent = $result[$i]['fitting_ident'];
		$brandResult = $brandmain->find(array('brand_ident' => $brandIdent));
		$fittingResult = $fittingmain->find(array('fitting_ident' => $fittingIdent));
		$result[$i]['brand_name'] = empty($brandResult) ? '' : $brandResult[0]['name'];
		$result[$i]['fitting_name'] = empty($fittingResult) ? '' : $fittingResult[0]['name'];
	}
	DbOper::show(1,'请求成功',$result);
});

/*配件更新*/
$app->post('/part/Updata', function() use($app){
	$partsmain 	= DbOper::model('parts.main');
	$data = array();
	$data['_id'] = new MongoId($_POST['data']['_id']);
	$query = $_POST['data'];
	$query['_id'] = new MongoId($query['_id']);
	$query['fitting_ident'] = (int)$query['fitting_ident'];
	$query['classify_ident'] = (int)$query['classify_ident'];
	$query['brand_ident'] = (int)$query['brand_ident'];
	$query['stock'] = (int)$query['stock'];
	$query['sale'] = (int)$query['sale'];
	$result = $partsmain->update($data, $query);
	DbOper::show(1,'更新成功',$result);
});

/*配件删除*/
$app->post('/part/Delete', function() use($app){
	$partsmain 	= DbOper::model('parts.main');
	$data['_id'] = new MongoId($_POST['data']['_id']);
	$result = $partsmain->delete($data);
	DbOper::show(1,'删除成功',$result);
});

/*配件添加*/
$app->post('/part/Insert', function() use($app){
	$partsmain 	= DbOper::model('parts.main');
	$data = $_POST['data'];
	$data['classify_ident'] = (int)$data['classify_ident'];
	$data['fitting_ident'] = (int)$data['fitting_ident'];
	$data['brand_ident'] = (int)$data['brand_ident'];
	$data['stock'] = (int)$data['stock'];
	$data['sale'] = (int)$data['sale'];
	$result = $partsmain->insert($data);
	DbOper::show(1,'添加成功',$result);
});

/*普通用户*/
$app->post('/ordinaryUser', function() use($app){
	$usersmain 	= DbOper::model('users.main');
	$result = $usersmain->findAll(array('customer' => 0));
	DbOper::show(1,'请求成功',$result);
});
/*普通用户更新*/
$app->post('/ordinaryUser/Updata', function() use($app){
	$usersmain 	= DbOper::model('users.main');
	$data = array();
	$data['_id'] = new MongoId($_POST['data']['_id']);
	$query = $_POST['data'];
	$query['_id'] = new MongoId($query['_id']);
	$query['customer'] = (int)$query['customer'];
	$result = $usersmain->update($data, $query);
	DbOper::show(1,'更新成功',$result);
});

/*普通用户删除*/
$app->post('/ordinaryUser/Delete', function() use($app){
	$usersmain 	= DbOper::model('users.main');
	$data['_id'] = new MongoId($_POST['data']['_id']);
	$result = $usersmain->delete($data);
	DbOper::show(1,'删除成功',$result);
});

/*普通用户添加*/
$app->post('/ordinaryUser/Insert', function() use($app){
	$usersmain 	= DbOper::model('users.main');
	$data = $_POST['data'];
	$data['customer'] = (int)0;
	$result = $usersmain->insert($data);
	DbOper::show(1,'添加成功',$result);
});
/*管理员*/
$app->post('/managerUser', function() use($app){
	$usersmain 	= DbOper::model('users.main');
	$result = $usersmain->findAll(array('customer' => 1));
	DbOper::show(1,'请求成功',$result);
});
/*管理员信息更新*/
$app->post('/managerUser/Updata', function() use($app){
	$usersmain 	= DbOper::model('users.main');
	$data['_id'] = new MongoId($_POST['data']['_id']);
	$query = $_POST['data'];
	$query['_id'] = new MongoId($query['_id']);
	$query['customer'] = (int)$query['customer'];
	$result = $usersmain->update($data, $query);
	DbOper::show(1,'更新成功',$query);
});
/*订单信息*/
$app->post('/order', function() use($app){
	$ordermain 	= DbOper::model('order.main');
	$partsmain 	= DbOper::model('parts.main');
	$usermain 	= DbOper::model('users.main');
	$partQuery = array();
	$userQuery = array();
	$partData = array();
	$userData = array();
	$result = $ordermain->findAll();
	for($i = 0; $i < count($result); $i++){
		$partQuery['_id'] = new MongoId($result[$i]['part_ident']); 
		$userQuery['_id'] = new MongoId($result[$i]['user_ident']); 
		$partData = $partsmain -> find($partQuery);
		$userData = $usermain -> find($userQuery);
		$result[$i]['part_name'] = $partData[0]['name'];
		$result[$i]['user_phone'] = $userData[0]['phone'];
	}
	DbOper::show(1,'请求成功',$result);
});
$app->post('/order/pay', function() use($app){
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
$app->post('/order/delete', function() use($app){
	$ordermain 	= DbOper::model('order.main');
	$data = array();
	$query = array();
	$data['_id'] = new MongoId($_POST['data']['_id']);
	$findResult = $ordermain -> delete($data);
	DbOper::show(1, '删除成功');
});
?>