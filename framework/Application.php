<?php

namespace Framework;

use Framework\Router\Router;
use Framework\Response\Response;
use Framework\Response\ResponseRedirect;
use Framework\Security\Security;
use Framework\Session\Session;
use Framework\DI\Service;
use Framework\Exception\RoleException;

/**
 * Application is a main class to load app
 * 
 * Its realization front controller pattern in framework
 * 
 * @author steemd
 */
class Application {

    /**
     * @var array $config
     */
    protected $config;

    /**
     * Constructor method include configuration file and add Servises
     * 
     * @param string $path
     */
    function __construct($path) {
        $this->config = include($path);
        Service::set('config', $this->config);
        Service::set('routes', $this->config['routes']);
        Service::set('pdo', $this->config['pdo']);
        Service::set('security', new Security());
        Service::set('session', new Session());
    }

    /**
     * Run Router class and show resalt of parseRoute()
     */
    public function run() {
        $router = new Router($this->config['routes']);

        $routeInfo = $router->parseRoute();

        try {
            if (is_array($routeInfo)) {
                Service::set('route', $routeInfo);

                if (isset($routeInfo['security'][0]) && !Service::get('session')->get('auth')){

                    if ($role == Service::get('session')->get('userRole')){
                       Session::set('returnUrl', Service::get('route')['pattern']);
                       throw new RoleException('You dont have anout permission to enter'); 
                    }     
                }
                
                $controllerName = $routeInfo['controller'];
                $actionName = $routeInfo['action'].'Action';
                $params = $routeInfo['params'];

                $reflectionClass = new \ReflectionClass($controllerName);

                if ($reflectionClass->isInstantiable()) {
                    $reflectionObj = $reflectionClass->newInstanceArgs();
                    
                    if ($reflectionClass->hasMethod($actionName)){   
                        $reflectionMethod = $reflectionClass->getMethod($actionName);
                        $response = $reflectionMethod->invokeArgs($reflectionObj, $params);
                        
                        if (!($response instanceof Response)) {
                            throw new \Exception('Method - <b>'. $actionName .'</b> return not instance of class Response');
                        }
                        
                    } else {
                        throw new \Exception('Can not find Method - '.  $actionName);
                    }
                    
                } else {
                    throw new \Exception('Can not create Object from Class - ' . $controllerName);
                }
            } else {
                throw new \Exception('404 - Page Not Found');
            }
        } catch (RoleException $e) {
            $response = new ResponseRedirect('/login');
            
        } catch (\Exception $e) {    
            $response = new Response('<b>My Message:</b> '.$e->getMessage().'<br />');
        }
        
        $response->send();
        
        echo '<pre>';
        print_r($_SESSION);
        echo '</pre>';
    }

}
