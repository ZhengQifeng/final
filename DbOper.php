<?php
class DbOper{
	static protected $db;
    static protected $redis;
    static protected $elastic;
    static protected $phone;
    static protected $sms;

    //打开数据库文件
	public static function model($name)
	{
		static $instance = array();
		$class = str_replace('.', '', ucwords($name, '\.'));
        $class = 'Model' . $class;
		if(!isset($instance[$name]))
		{
		    if(!class_exists($class))
			{
				require(DOC_ROOT. '/model/model.'. $name . '.php');
			}
			$instance[$name] = new $class;
		}

	    return $instance[$name];
	}

	static public function db($collection) {
        $allowedCollections = Config::$db['mongo']['collections'];
        if(!is_object(self::$db)) {
            $m = new MongoClient();
            $dataName = Config::$db['mongo']['name'];
            self::$db = $m->selectDB($dataName);
        }     
        if(in_array($collection, $allowedCollections)) {
            return self::$db->$collection;
        } else {
            return null;
        }
    }

    //返回两个数组键名交际部分
    static public function allowed($data, $allowed){
        return array_intersect_key($data, array_flip($allowed)); 
    }

    public static function show($code,$message,$data=array()){
        $data=array(
            'code'=>$code,
            'message'=>$message,
            'data'=>$data
        );
        exit(json_encode($data));
    }
}
?>