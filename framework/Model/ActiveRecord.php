<?php

namespace Framework\Model;

use Framework\DI\Service;
use Framework\Session\Session;
use Framework\Exception\DatabaseException;

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
     * Method save or update one Post in DB
     * 
     * @throws \Exception
     */
    public function save() {
        $db = self::getDbConnection();
        $table = static::getTable();
        $data = get_object_vars($this);
        if ($table == 'posts') {
            $data['name'] = Service::get('session')->userEmail;
        }

        if (isset($data['id'])) {
            $query = $db->prepare($this->getUpdateString($data, $table));
        } else {
            $query = $db->prepare($this->getInsertString($data, $table));
        }

        if (!$query->execute()) {
            throw new DatabaseException('Cant save object');
        }
    }

    /**
     * Remove one iten from DB
     * 
     * @param type $id
     * @throws \Exception
     */
    static function remove($id = null) {
        $db = self::getDbConnection();
        $table = static::getTable();

        if (is_null($id)) {
            throw new \Exception('Cant remove item, incorrect ID');
            
        } else {
            $id = (int) $id;
            $query = $db->prepare("DELETE FROM $table WHERE id = " . $id . ";");
            if (!$query->execute()) {
                throw new \Exception('Cant remove item');
            }
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
    private function getInsertString($data, $table) {
        $attr = '';
        $values = '';

        foreach ($data as $key => $val) {
            if ($val instanceof \DateTime) {
                $val = $val->format('Y-m-d H:i:s');
            }
            if ($attr == '' && $values == '') {
                $attr .= $key;
                $values .= "'" . trim(addslashes(htmlspecialchars($val))) . "'";
            } else {
                $attr .= ", " . $key;
                $values .= ", '" . trim(addslashes(htmlspecialchars($val))) . "'";
            }
        }
        return "INSERT INTO " . $table . " (" . $attr . ") VALUES (" . $values . ");";
    }

    /**
     * Method return Update SQL string whit binding data
     * 
     * @param array $data
     * @param string $table
     * 
     * @return string @sql
     */
    private function getUpdateString($data, $table) {
        $attrVal = '';
        $id = (int) $data['id'];

        foreach ($data as $key => $val) {
            if ($key !== 'id') {
                if ($val instanceof \DateTime) {
                    $val = $val->format('Y-m-d H:i:s');
                }
                if ($attrVal == '') {
                    $attrVal .= $key . " = '" . addslashes(htmlspecialchars($val)) . "'";
                } else {
                    $attrVal .= ", " . $key . " = '" . addslashes(htmlspecialchars($val)) . "'";
                }
            }
        }

        return "UPDATE " . $table . " SET " . $attrVal . " WHERE id = " . $id . ";";
    }

    /**
     * Return User object by Attribute name
     * 
     * @param string $name
     * @param array $arguments
     * 
     * @return mixed
     */
    static public function __callStatic($name, $arguments) {
        if (stristr($name, 'findBy') !== false) {
            $db = self::getDbConnection();
            $table = static::getTable();

            $attr = lcfirst(str_replace('findBy', '', $name));

            $query = $db->prepare("SELECT * FROM {$table} WHERE $attr = :{$attr}");
            $query->execute(array(":{$attr}" => $arguments[0]));
            $resalt = $query->fetchObject();

            return $resalt;
        } else {
            return false;
        }
    }

}
