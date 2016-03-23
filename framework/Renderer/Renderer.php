<?php

namespace Framework\Renderer;

use Framework\DI\Service;
use Framework\Request\Request;
use Framework\Session\Session;

/**
 * Renderer is uisng to return correct content to App
 *
 * @author steemd
 */
class Renderer {

    /**
     * @var string $layoutUrl
     * @var string $templateUrl
     * @var array $date
     */
    private $layoutUrl;
    private $templateUrl;
    private $data;

    /**
     * Constructor method init all properties in Renderer Class
     * 
     * @param type $template
     * @param type $data
     * @param type $className
     */
    function __construct($template, $data = array(), $className) {
        $config = Service::get('config');
        
        $bandle = explode('\\', $className);
        $bandleName = array_shift($bandle);
        $bandleController = str_replace('Controller', '', array_pop($bandle));

        $this->templateUrl =  __DIR__.'/../../src/'.$bandleName.'/views/'.$bandleController.'/'.$template.'.php';
        $this->data = $data;
        $this->layoutUrl = $config['main_layout'];
    }

    /**
     * Renderer and return all content to Response Class
     * 
     * @return string $resalt
     */
    public function renderContent() {

        extract($this->data);
        
        if (!empty($errors['token'])){
            $error = $errors['token'];
        }

        $include = function($controllerName, $actionName, $data = array()) { 
            $reflectionMethod  = new \ReflectionMethod($controllerName, $actionName.'Action');
            $response = $reflectionMethod->invokeArgs(new $controllerName(), $data);
            echo '<h3>Include</h3>';
            echo '<p>';
            $response->getContent();
            echo '</p>';
        };
        
        $generateToken = function(){
            $token = md5('solt_string'.uniqid());
            Session::set('token', $token);      
            echo '<input type="hidden" value="'.$token.'" name="token">';
        };
        
        $getRoute = function($name) {
            $routes = Service::get('routes');
            return $routes[$name]['pattern'];
        };
        
        $route = Service::get('route');
        
        if (Session::get('auth')){
           $user = Service::get('security')->getUser(); 
        }

        if (isset(Service::get('session')->flash)){
            $flush = array(
                'info' => array(Service::get('session')->flash,
                    )
            );
            unset(Service::get('session')->flash);
        } else {
            $flush = array();
        }

        //Render template
        ob_start();
        include $this->templateUrl;
        $content = ob_get_contents();
        ob_end_clean();

        //Render main layout 
        ob_start();
        include $this->layoutUrl;
        $result = ob_get_contents();
        ob_end_clean();
        
        return $result;
    }
}
