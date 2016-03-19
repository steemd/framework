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
        $viewNameDir = str_replace('Controller', '', str_replace('Blog\\Controller\\', '', $className));

        $this->templateUrl =  __DIR__.'/../../src/Blog/views/'.$viewNameDir.'/'.$template.'.php';
        $this->data = $data;
        $this->layoutUrl = $config['main_layout'];
    }

    /**
     * Renderer and return all content to Response Class
     * 
     * @return string $resalt
     */
    public function getContent() {

        extract($this->data);
        
        if (!empty($errors['token'])){
            $error = $errors['token'];
        }

        $include = function($controllerName, $actionName, $data = array()) { 
            $reflectionMethod  = new \ReflectionMethod($controllerName, $actionName.'Action');
            $response = $reflectionMethod->invokeArgs(new $controllerName(), $data);
            echo '<br /><br /><p class="alert alert-info">';
            $response->getContent();
            echo '</p>';
        };
        
        $generateToken = function(){
            $token = md5('solt_string'.uniqid());
            setcookie('token', $token);      
            echo '<input type="hidden" value="'.$token.'" name="token">';
        };
        
        $getRoute = function($name) {
            $routes = Service::get('routes');
            $route = $routes[$name]['pattern'];
            return $route;
        };

        ob_start();
        include $this->templateUrl;
        $content = ob_get_contents();
        ob_end_clean();

        $resalt  = $this->getMainContent($content);
        
        return $resalt;
    }
    
    /**
     * Render main layout with content block an return it
     * 
     * @param string $content
     * 
     * @return string $resalt
     */
    public function getMainContent($content){
        $route = Service::get('route');
        
        if (Session::get('auth')){
           $user = Service::get('security')->getUser(); 
        }
   
        $getRoute = function($name) {
            $routes = Service::get('routes');
            return $routes[$name]['pattern'];
        };

        $flush = array();
        
        ob_start();
        include $this->layoutUrl;
        $resalt = ob_get_contents();
        ob_end_clean();
        
        return $resalt;    
    }

}
