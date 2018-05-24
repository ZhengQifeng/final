<?php
require('common.php');  //加载全局变量和数据库类

require 'vendor/autoload.php';  //载入 Composer 的自动加载器

$config = require 'config.php';  //加载配置选项

$app = new \Slim\Slim($config);  //应用配置选项

$app->group('/login', function() use($app){  //登录
	require 'login.php';
});

$app->group('/home', function() use($app){  //登录
	require 'home.php';
});

$app->group('/searchProduct', function() use($app){  //登录
	require 'searchProduct.php';
});

$app->group('/fittingDetails', function() use($app){  //登录
	require 'fittingDetails.php';
});

$app->group('/admin', function() use($app){  //登录
	require 'admin.php';
});

$app->group('/userNews', function() use($app){  //登录
	require 'userNews.php';
});

$app->group('/shopping', function() use($app){  //登录
	require 'shopping.php';
});
$app->run();