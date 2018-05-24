<?php
$app->get('/', function() use($app){
	session_start();
	$phone = '';
	if(empty($_SESSION['user'])){
		$result = 0;
	}else{
		$result = 1;
		$phone = $_SESSION['user'];
	}
	$fittingmain = DbOper::model('fitting.main');   
	$fitting = $fittingmain->findAll();    
	$classifymain = DbOper::model('classify.main');   
	$classify = $classifymain->findAll();     
	$brandmain = DbOper::model('brand.main');    
	$brand = $brandmain->find(array(), array(), 24);    
	$partsmain = DbOper::model('parts.main');   
	$hotParts = $partsmain->find(array(), array('sale' => -1,'name' => 1), 18);
	foreach($classify as $key => $item){
		$classifyIdent = $item['classify_ident'];
		$classifyParts = $partsmain->find(array('classify_ident' => $classifyIdent), array('sale' => -1,'name' => 1), 10);
		foreach($classifyParts as $key2 => $item2){
			$classify[$key] = array_merge(array('classifyParts' => array()), $classify[$key]);
			array_push($classify[$key]['classifyParts'],$item2);
		}
	}
	$data = array(
    	'mainTitle' => '车配首页',
    	'js' => array('/final/src/dist/home.js'),
    	'name' => 'zhengqifeng',
    	'result' => $result,
    	'phone' => $phone,
    	'fitting' => $fitting,
    	'classify' => $classify,
    	'brand' => $brand,
    	'hotParts' => $hotParts,
    );
   	$app ->render('home.html',$data);
});
// $app->get('/user', function() use($app){
// 	session_start();
// 	if(empty($_SESSION['user'])){
// 		echo json_encode(array('result' => 0));
// 	}else{
// 		echo json_encode(array('result' => 1, 'phone' => $_SESSION['user']));
// 	}
// })
?>