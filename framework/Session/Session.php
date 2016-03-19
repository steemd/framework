<?php

namespace Framework\Session;

/**
 * Description of Session
 *
 * @author steemd
 */
class Session {
    
    /**
     *
     * @var type 
     */
    public $returnUrl = null;
    
    /**
     * Initial session start
     */
    function __construct() {
        session_start();
    } 
    
    /**
     * Save session data
     * 
     * @param type $name
     * @param type $value
     */
    static function set($name, $value) {
        $_SESSION[$name] = $value;
    }
    
    /**
     * Return data from session
     * 
     * @param type $name
     * @return type
     */
    static function get($name) {
        return $_SESSION[$name];
    }
    
    
}
