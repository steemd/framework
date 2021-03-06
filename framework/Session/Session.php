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
     * Unset SESSION var
     * 
     * @param type $name
     */
    function __unset($name) {
        unset($_SESSION[$name]);
    }

    /**
     * Return TRUE or FALSE for SESSION var
     * 
     * @param type $name
     * @return type
     */
    function __isset($name) {
        return isset($_SESSION[$name]);
    }
    /**
     * Interface to save session data
     * 
     * @param type $name
     * @param type $value
     */
    public static function set($name, $value) {
        $_SESSION[$name] = $value;
    }
    
    /**
     * Interface to get data from session
     * 
     * @param type $name
     * @return type
     */
    public static function get($name) {
        return $_SESSION[$name];
    }
    
    
}
