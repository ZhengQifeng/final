<?php 
class ModelUsersMain {
    private $errMsg;
    private $allowed = array(
    	'phone',
    	'password',
        'name',
        'customer',
        'pic_src',
        'place'
    );

    public function collection() {
        return DbOper::db('users');
    }

    /*添加成员*/
    public function insert($data) {
        $collection    = $this->collection();
        $data = DbOper::allowed($data, $this->allowed);
    	$result        = $collection->insert($data);
    	return $result;
    }

    /*更新成员*/
    public function update($data, $query) {
        $collection    = $this->collection();
        $data          = $data;
        $query         = $query;
        $result        = $collection->update($data, $query);
        return $result;
    }

    /*删除成员*/
    public function delete($data) {
        $collection    = $this->collection();
        $data          = $data;
        $result        = $collection->remove($data, array("justOne" => true));
        return $result;
    }

    /*查看成员*/
    public function find($query = array(), $sort = array('name' => 1), $limit = 0, $skip = 0) {
        $groups = array();
        $query  = $query;
        $sort  = $sort;
        $limit = $limit;
        $skip = $skip;
        $collection    = $this->collection();
        $cursor = $collection->find($query)->sort($sort)->skip($skip)->limit($limit);
        foreach($cursor as $row) {
            $row['_id'] = (string)$row['_id'];
            $groups[]   = $row;
        }
        return $groups;
    }

    /*查找一个成员*/
    public function findOne($data) {
        $collection    = $this->collection();
        $data          = $data;
        $result        = $collection->findOne($data);
        return $result;
    }

    /*查看全部成员*/
    public function findAll($query = array()) {
        $groups = array();
        $collection    = $this->collection();
        $cursor = $collection->find($query);
        $cursor->sort(array('password' => 1));
        foreach($cursor as $row) {
            $row['_id'] = (string)$row['_id'];
            $groups[]   = $row;
        }
        return $groups;
    }
}
?>