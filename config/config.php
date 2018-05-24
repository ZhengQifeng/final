<?php
class Config{
      public static $admin = array(    //全局变量
            'title' => '汽配查询',
            'resVersion' => '4',    //静态文件版本号，如：css,js等
            'res3rdVersion' => '2'    //第三方静态资源版本号，jQuery, awesome等
      );
	public static $db = array(
		'mongo' => array(
      		'host'        => 'localhost',
                  'port'        => 27017,
                  'name'        => 'autoParts',
                  'collections' => array(
                  	'user',
                  	'users',
                        'fitting',
                        'classifyParts',
                        'brand',
                        'parts',
                        'order'
                  )
		)
	);
      public static function setUser($userItme){
            self::$user = $userItme;
      }
}