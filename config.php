<?php
// config.php

define('SLIM_ROOT', __DIR__);   

return array(
    'debug' => true,  //打开debug模式
    'mode' => 'development',  //打开开发模式
    'view' => new View\Twig(),
    'templates.path' => __DIR__ . '/view'  //将view作为页面根目录
);