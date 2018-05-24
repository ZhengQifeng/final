<?php
class comFun{
    //返回两个数组键名交际部分
    static public function allowed($data, $allowed){
        return array_intersect_key($data, array_flip($allowed)); 
    }
    static public function anayStrUrlQuery($query){
        $urlQuery='';
        $arr1=explode('&sortType&', $query);
        $urlQuery=$arr1[0];
        return $urlQuery;
    }
    //解析url参数
    static public function anayStrQuery($query){
        $urlQuery=comFun::anayStrUrlQuery($query);
        $arr=array();  
        $data=array();
        $arr=explode('&', $urlQuery);
        foreach ($arr as $val) {    
            $tmp = explode('=', $val);
            if($tmp[0] == 'fitting_ident' || $tmp[0] == 'classify_ident' || $tmp[0] == 'brand_ident'){
                $tmp[1] = (int)$tmp[1];
            }else if($tmp[0] == '_id'){
                $tmp[1] = new MongoId($tmp[1]);
            }else if($tmp[0] == 'fitting_name'){
                $tmp[1] = '/'.$tmp[1].'/';
                $result = array();
                $fittingmain  = DbOper::model('fitting.main');
                $tmp[1] = new MongoRegex(urldecode(iconv("gb2312","UTF-8",$tmp[1])));
                $query = array('name' => $tmp[1]);
                $result = $fittingmain -> find($query, array(), 0, 0, array('fitting_ident' => 1, '_id' => 0));
                $data['$or'] = $result;
                continue;
            }else if($tmp[0] == 'brand_name'){
                $tmp[1] = '/'.$tmp[1].'/';
                $result = array();
                $brandmain  = DbOper::model('brand.main');
                $tmp[1] = new MongoRegex(urldecode(iconv("gb2312","UTF-8",$tmp[1])));
                $query = array('name' => $tmp[1]);
                $result = $brandmain -> find($query, array(), 0, 0, array('brand_ident' => 1, '_id' => 0));
                $data['$or'] = $result;
                continue;
            }else if($tmp[0] == 'name' || $tmp[0] == 'business_name'){
                $tmp[1] = '/'.$tmp[1].'/';
                $tmp[1] = new MongoRegex(urldecode(iconv("gb2312","UTF-8",$tmp[1])));
                $query = array($tmp[0] => $tmp[1]);
                $data['$or'][0] = $query;
                continue;
            }
            $data[$tmp[0]] = $tmp[1];
        }
        return $data;
    }
    //解析url查询参数
    static public function anayStrSort($query){
        $arr=array();  
        $data=array();
        $arr1=explode('&sortType&', $query);
        if(count($arr1) > 1){
            $arr=explode('&', $arr1[1]);
            foreach ($arr as $val) {    
                $tmp = explode('=', $val);
                    $data[$tmp[0]] = (int)$tmp[1];  
            }  
        }
        return $data;
    }
}
?>