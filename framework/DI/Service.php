<?php

namespace Framework\DI;

/**
 * Description of Service
 *
 * @author steemd
 */
class Service {
    
    /**
     * @var array  $services
     */
    private static $services = array();
    
    /**
     * Add new object to Service storage
     * 
     * @param string $name
     * @param mixed $data
     */
    public static function set($name, $data){
        self::$services[$name] = $data;
    }
    
    /**
     * Return mixed data from Service storage
     * 
     * @param string $name
     * @return mixed Storage data
     */
    public static function get($name){
        if (empty(self::$services[$name])) {
            return null;
        } else {
            return self::$services[$name];
        }
        
    }
}
