<?php

namespace Framework;

use Framework\Router\Router;
use Framework\Response\Response;

/**
 * Application is a main class to load app
 * 
 * Its realization front controller pattern in framework
 * 
 * @author steemd
 */
class Application {

    /**
     * @var array 
     */
    protected $config;

    /**
     * Constructor method include configuration file
     * 
     * @param string $path
     */
    function __construct($path) {
        $this->config = include($path);
    }

    /**
     * Run Router class and show resalt of parseRoute()
     */
    public function run() {
        $router = new Router($this->config['routes']);

        $routeInfo = $router->parseRoute();

        try {
            if (is_array($routeInfo)) { 
                $controllerName = $routeInfo['controller'];
                $actionName = $routeInfo['action'].'Action';
                $params = $routeInfo['params'];

                $reflectionClass = new \ReflectionClass($controllerName);

                if ($reflectionClass->isInstantiable()) {
                    $reflectionObj = $reflectionClass->newInstanceArgs();
                    
                    if ($reflectionClass->hasMethod($actionName)){   
                        $reflectionMethod = $reflectionClass->getMethod($actionName);
                        $response = $reflectionMethod->invokeArgs($reflectionObj, $params);
                        
                    } else {
                        throw new \Exception('Can not find Method - '.  $actionName);
                    }
                    
                } else {
                    throw new \Exception('Can not create Object from Class - ' . $controllerName);
                }
            } else {
                throw new \Exception('404 - Page Not Found');
            }
        } catch (\Exception $e) {
            echo '<b>Warning:</b> ' . $e->getMessage() . '<br />';
        }
        
        $response->send();
        
    }

}
