<?php

class BaseModel extends DB\SQL\Mapper
{

    private $table_name;
    protected $exception;

    private $arrResult;

    public function __construct(DB\SQL $db, $table_name)
    {
        $this->table_name = $table_name;
        parent::__construct($db, $table_name);
    }

    public static function getTableNames(DB\SQL $db)
    {
        $query = "SELECT table_name FROM information_schema.tables where table_type='BASE TABLE' and table_schema='" . $db->name() . "'";
        return $db->exec($query);
    }

    public static function getTablesAndViews(DB\SQL $db)
    {
        $query = "SELECT table_name, table_type FROM information_schema.tables where table_schema='" . $db->name() . "'";
        return $db->exec($query);
    }

    public function all($order = false, $limit = 0, $offset = 0)
    {
        if (!$order && $limit == 0) {
            $this->load();
        } else if ($order && $limit == 0) {
            $this->load(array(), array('order' => $order, 'offset' => $offset));
        } else if (!$order && $limit >= 0) {
            $this->load(array(), array('limit' => $limit, 'offset' => $offset));
        } else {
            $this->load(array(), array('order' => $order, 'limit' => $limit, 'offset' => $offset));
        }

        if(!$this->dry()) {
            if(count($this->query) == 1)
                return BaseModel::toObject($this->query[0]);
            else {
                return array_map(function ($obj) {
                    return BaseModel::toObject($obj);
                }, $this->query);
            }
        }
        else {
            return [];
        }
    }

    function mapArrayToObject($array, &$obj)
    {
        foreach ($array as $key => $value)
        {
            if (is_array($value))
            {
                $obj->$key = new stdClass();
                mapArrayToObject($value, $obj->$key);
            }
            else
            {
                $obj->$key = $value;
            }
        }
        return $obj;
    }

    public function findAll($order = false, $limit = 0, $offset = 0)
    {
        $result = null;

        if (!$order && $limit == 0) {
            $result = $this->find();
        } else if ($order && $limit == 0) {
            $result = $this->find(array(), array('order' => $order, 'offset' => $offset));
        } else if (!$order && $limit >= 0) {
            $result = $this->find(array(), array('limit' => $limit, 'offset' => $offset));
        } else {
            $result = $this->find(array(), array('order' => $order, 'limit' => $limit, 'offset' => $offset));
        }
        $result = array_map(array($this, 'cast'), $result);

        return $result;
    }

    public function getFullSchema()
    {

        return $this->schema();
    }

    public function getContraints()
    {

        $query = "SELECT COLUMN_NAME,CONSTRAINT_NAME, REFERENCED_TABLE_NAME,REFERENCED_COLUMN_NAME 
           FROM INFORMATION_SCHEMA.KEY_COLUMN_USAGE
           WHERE TABLE_SCHEMA = 'gsr_ae' AND TABLE_NAME = '$this->table_name'";

        return $this->db->exec($query);
    }

    public function getById($value)
    {
        $this->load(array("id=?", $value));
        if(!$this->dry()){
            return BaseModel::toObject($this->query[0]);
        }
        else {
            return null;
        }
    }

    public function getByField($name, $value, $order = false)
    {
        if ($order) {
            $this->load(array("$name=?", $value), array('order' => $order));
        } else {
            $this->load(array("$name=?", $value));
        }

        if(!$this->dry()) {
            if(count($this->query) == 1)
                return BaseModel::toObject($this->query[0]);
            else {
                return array_map(function ($obj) {
                    return BaseModel::toObject($obj);
                }, $this->query);
            }
        }
        else {
            return null;
        }
    }

    public function getWhere($where, $order = "", $limit = 0, $offset = 0)
    {
        $this->load(array($where), array('order' => $order, 'limit' => $limit, 'offset' => $offset));
        if(!$this->dry()) {
            return array_map(function ($obj) {
                return BaseModel::toObject($obj);
            }, $this->query);
        }
        else {
            return [];
        }
    }

    public function findWhere($where, $order = "", $limit = 0, $offset = 0)
    {
        $result = null;
        if ($order == "") {
            $result = $this->find(array($where));
        } else if ($limit == 0) {
            $result = $this->find(array($where), array('order' => $order, 'offset' => $offset));
        } else {
            $result = $this->find(array($where), array('order' => $order, 'limit' => $limit, 'offset' => $offset));
        }
        $result = array_map(array($this, 'cast'), $result);

        return $result;
    }

    public function getCurrentDateTime()
    {
        return date('Y-m-d H:i:s');
    }

    public function addReturnID()
    {
        try {
            $this->insert();
            return $this->get('_id');
        } catch (Exception $ex) {
            $this->exception = $ex->getMessage() . " - " . $ex->getTraceAsString();
            return false;
        }
    }

    public function addAndLoadById($idName = null)
    {
        try {
            $this->insert();
            $id = $this->get('_id');
            return $this->getByField($idName == null ? 'id' : $idName, $id);
        } catch (Exception $ex) {
            $this->exception = $ex->getMessage() . " - " . $ex->getTraceAsString();
            return false;
        }
    }

    public function add()
    {
        try {
            $this->insert();
            $this->id = $this->get('_id');
            return TRUE;
        } catch (Exception $ex) {
            $this->exception = $ex->getMessage() . " - " . $ex->getTraceAsString();
            return $this->exception;
        }
    }

    public function addSilent()
    {
        try {
            $this->insert();
            return true;
        } catch (Exception $ex) {
            $this->exception = $ex->getMessage() . " - " . $ex->getTraceAsString();
            return false;
        }
    }

    public function edit()
    {
        try {
            $this->update();
            return TRUE;
        } catch (Exception $ex) {
            $this->exception = $ex->getMessage() . " - " . $ex->getTraceAsString();
            return false;
        }
    }

    public function delete()
    {
        try {
            if (isset($this->isActive)) {
                if ($this->isActive == 0) {
                    $this->exception = "Already deleted";
                    return false;
                }
                $this->isActive = 0;
                $this->update();
            } else {
                $this->erase();
            }
            return TRUE;
        } catch (Exception $ex) {
            $this->exception = $ex->getMessage() . " - " . $ex->getTraceAsString();
            return false;
        }
    }

    public static function escapeMySQL($inp)
    {
        if (is_array($inp))
            return array_map(__METHOD__, $inp);

        if (!empty($inp) && is_string($inp)) {
            return str_replace(array('\\', "\0", "\n", "\r", "'", '"', "\x1a"), array('\\\\', '\\0', '\\n', '\\r', "\\'", '\\"', '\\Z'), $inp);
        }

        return $inp;
    }

    private static function array_to_obj($array, &$obj)
    {
        foreach ($array as $key => $value)
        {
            if (is_array($value))
            {
                $obj->$key = new stdClass();
                array_to_obj($value, $obj->$key);
            }
            else
            {
                $obj->$key = $value;
            }
        }
        return $obj;
    }

    public static function toObject($array)
    {
        $object= new stdClass();
        return BaseModel::array_to_obj($array,$object);
    }

    public function getException(){
        return $this->exception;
    }

    public function generateRandomString($length = 10)
    {
        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function getDatatableData($where='', $page=1, $pageSize=10, $field='', $sort=''){
        return $this->getWhere($where, "$field $sort", $pageSize, ($page-1)*$pageSize);
    }

    public function getDatatableCount($where=''){
        return $this->count($where);
    }
}