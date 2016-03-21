<?php

namespace Framework\Session;

/**
 * Description of Session
 *
 * @author steemd
 */
class Session {
 
    /**
     * Initial session start
     */
    function __construct() {
        session_start();
    } 
    
    /**
     * Get Session data
     * 
     * @param type $name
     * @return type
     */
    function __get($name) {
        return self::get($name) ? self::get($name) : null;
    }
    
    /**
     * Set Session data
     * 
     * @param type $name
     * @param type $value
     */
    function __set($name, $value) {
        $_SESSION[$name] = $value;
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
