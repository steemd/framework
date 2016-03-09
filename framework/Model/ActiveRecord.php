<?php

namespace Framework\Model;

use Framework\DI\Service;

/**
 * ActiveRecord its main Model Class to get connection whith DB
 *
 * @author steemd
 */
abstract class ActiveRecord {

    /**
     * @var object $db 
     */
    static public $db;

    /**
     * Consrtuctor method
     */
    function __construct() {
    }

    /**
     * getDbConnection return current DB connection or create new if not exist
     * 
     * @return type
     */
    static function getDbConnection() {

        if (empty(static::$db)) {
            $pdo = Service::get('pdo');
            static::$db = new \PDO($pdo['dns'], $pdo['user'], $pdo['password']);
        }
        return static::$db;
    }

    /**
     * Return array Post object
     * 
     * @param mixed $data
     * 
     * @return type
     */
    static function find($data = 'all') {
        $db = self::getDbConnection();
        $table = static::getTable();
        $resalt = array();

        if ($data == 'all') {
            $query = $db->prepare("SELECT * FROM $table ORDER BY id ASC");
            $query->execute();

            while ($obj = $query->fetchObject()) {
                $resalt[] = $obj;
            }
        } else {
            $query = $db->prepare("SELECT * FROM $table WHERE id = :id");
            $query->execute(array(':id' => $data));

            $resalt = $query->fetchObject();
        }

        return $resalt;
    }
    
    /**
     * Method save new Post row in DB
     */
    public function save(){
        $db = self::getDbConnection();
        $table = static::getTable();
        $data = get_object_vars($this);
        
         $query = $db->prepare($this->getInsertQuery($data, $table));    
         if ($query->execute()) {
             echo 'Insert Ok';
         } else {
             echo 'Error';
         }     
    }
    
    /**
     * Method return Insert SQL string whit binding data
     * 
     * @param array $data
     * @param string $table
     * 
     * @return string @sql
     */
    private function getInsertQuery($data, $table) {
        $attr = '';
        $values = '';
        
        foreach ($data as $key=>$val){
            
            if ($val instanceof \DateTime){
                $val = $val->format('Y-m-d H:i:s');
            }
            $attr .= "`".$key."`, ";
            $values .= "'".$val."', ";
        }
        
        $attr = trim($attr);
        $attr = substr($attr, 0, strlen($attr)-1);
        
        $values = trim($values);
        $values = substr($values, 0, strlen($values)-1);

        return "INSERT INTO ".$table."(".$attr.") VALUES (".$values.");";
    }

}