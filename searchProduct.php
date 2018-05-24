<?php
$app->get('/', function() use($app){
	session_start();
	$phone = '';
	$sortType = '';
	$brand = array();
	$brandData = array();
	$result = array();
	$count = 0;
	$partsmain 	= DbOper::model('parts.main');
	$brandsmain 	= DbOper::model('brand.main');
	$urlData = $_SERVER["QUERY_STRING"];
	$query = comFun::anayStrQuery($urlData);
	$sort = comFun::anayStrSort($urlData);
	$sortType = empty($sort) ? '' : array_keys($sort)[0];
	$urlQuery = comFun::anayStrUrlQuery($urlData);
	if(array_key_exists('$or', $query) && empty($query['$or'])){
		$findResult = array();
	}else{
		$findResult = $partsmain -> find($query, $sort, 16);
		for($i = 0 ; $i < count($findResult); $i++){
			$brand[$i] = $findResult[$i]['brand_ident'];
		}
		$brand = array_unique($brand);
		$i = 0;
		foreach ($brand as $key => $value) {
			$brandQuery = array('brand_ident' => $value);
			$brandData[$i] = $brandsmain -> find($brandQuery);
			$i++;
		}
		$count = $partsmain -> count($query);
	}
	if(empty($_SESSION['user'])){
		$result = 0;
	}else{
		$result = 1;
		$phone = $_SESSION['user'];
	}
	$data = array(
    	'mainTitle' => '配件搜索',
    	'js' => array('/final/src/dist/searchProduct.js'),
    	'name' => 'zhengqifeng',
    	'result' => $result,
    	'phone' => $phone,
    	'partsResult' => $findResult,
    	'count' => $count,
    	'urlQuery' => $urlQuery,
    	'brandResult' => $brandData,
    	'sort' => $sortType
    );
   	$app ->render('searchProduct.html',$data);
});
$app->post('/', function() use($app){
	$sortType = '';
	$result = array();
	$limit = (int)$app->request->post('limit', null);
	$partsmain 	= DbOper::model('parts.main');
	$urlData = $_SERVER["QUERY_STRING"];
	$query = comFun::anayStrQuery($urlData);
	$sort = comFun::anayStrSort($urlData);
	$findResult = $partsmain -> find($query, $sort, 16 , 16*($limit-1));
	DbOper::show(1, '请求成功', $findResult);
});
?>