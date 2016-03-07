<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Framework\DI;

/**
 * Description of Service
 *
 * @author steemd
 */
class Service {
    
    private static $services = array();
    
    public static function set($name, $data){
        self::$services[$name] = $data;
    }
    
    public static function get($name){
        if (empty(self::$services[$name])) {
            return null;
        } else {
            return self::$services[$name];
        }
        
    }
}
