<?php

namespace Framework\Request;

/**
 * Request return Fet and Post data
 *
 * @author steemd
 */
class Request {
    
    /**
     * Class constructor
     */
    function __construct() {
    }
    
    /**
     * Return $_POST data by name
     * 
     * @param type $name
     * @return type $data
     */
    public function post($name){  
        $data = $_POST[$name];   
        return $data;
    }
    
     /**
     * Return $_GET data by name
     * 
     * @param type $name
     * @return type $data
     */
    public function get($name){  
        $data = $_GET[$name];   
        return $data;
    }
    
     /**
     * Return $_COOKIE data by name
     * 
     * @param type $name
     * @return type $data
     */
    public function getCookie($name){  
        $data = $_COOKIE[$name];   
        return $data;
    }

    /**
     * Method return Post status
     * 
     * @return boolean
     */
    public function isPost(){
        return ($_SERVER['REQUEST_METHOD'] == 'POST');
    }
    
    /**
     * Method return Get status
     * 
     * @return boolean
     */
    public function isGet(){
        return ($_SERVER['REQUEST_METHOD'] == 'GET');
    }
}
