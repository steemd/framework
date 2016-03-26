<?php

namespace Framework;

use Framework\Router\Router;
use Framework\Response\Response;
use Framework\Response\ResponseRedirect;
use Framework\Security\Security;
use Framework\Session\Session;
use Framework\DI\Service;
use Framework\Exception\RoleException;
use Framework\Exception\HttpNotFoundException;
use Framework\Exception\DatabaseException;
use Framework\Exception\CustomException;
use Framework\Request\Request;

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

                //Security - user Role Verification
                Service::get('security')->verifyUserRole();
                // Security - validation token
                Service::get('security')->verifyCsrfToken();

                $controllerName = $routeInfo['controller'];
                $actionName = $routeInfo['action'] . 'Action';
                $params = $routeInfo['params'];

                $reflectionClass = new \ReflectionClass($controllerName);

                if ($reflectionClass->isInstantiable()) {
                    $reflectionObj = $reflectionClass->newInstanceArgs();

                    if ($reflectionClass->hasMethod($actionName)) {
                        $reflectionMethod = $reflectionClass->getMethod($actionName);
                        $response = $reflectionMethod->invokeArgs($reflectionObj, $params);

                        if (!($response instanceof Response)) {
                            throw new \Exception('Method - <b>' . $actionName . '</b> return not instance of class Response');
                        }
                    } else {
                        throw new \Exception('Can not find Method - ' . $actionName);
                    }
                } else {
                    throw new \Exception('Can not create Object from Class - ' . $controllerName);
                }
            } else {
                throw new HttpNotFoundException('Page Not Found');
            }
        } catch (RoleException $e) {
            $response = new ResponseRedirect('/login');
        } catch (HttpNotFoundException $e) {
            $content = $e->getExceptionContent('Error - 404');
            $response = new Response($content, 404);
        } catch (CustomException $e) {
            $content = $e->getExceptionContent();
            $response = new Response($content, 500);
        } catch (\Exception $e) {
            $response = new Response('<b>Message:</b> ' . $e->getMessage() . '<br />');
        }

        $response->send();
    }

}
