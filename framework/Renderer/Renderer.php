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
     */
    private $layoutUrl;
    
    /**
     * @var string $templateUrl
     */
    private $templateUrl;
    
    /**
     * @var array $data 
     */
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

        //get all controller input data 
        extract($this->data);

        //include controller relust in content
        $include = function($controllerName, $actionName, $data = array()) { 
            $reflectionMethod  = new \ReflectionMethod($controllerName, $actionName.'Action');
            $response = $reflectionMethod->invokeArgs(new $controllerName(), $data);
            echo '<h3>Include</h3>';
            echo '<p>';
            $response->getContent();
            echo '</p>';
        };
        
        //generate CSRF token to hidden form element
        $generateToken = function(){
            $csrfToken = Service::get('security')->generateCsrfToken();
            echo '<input type="hidden" value="'.$csrfToken.'" name="csrfToken">';
        };
        
        //get current route information
        $getRoute = function($name) {
            $routes = Service::get('routes');
            return $routes[$name]['pattern'];
        };
        
        $route = Service::get('route');
        
        $request = new Request();
        
        if($request->isPost() && empty($post)){
            $post = new \stdClass();
            $post->title = $request->post('title');
            $post->content = $request->post('content');
        }
        
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
        $this->renderDevMode();        
        $result = ob_get_contents();
        ob_end_clean();
        
        return $result;
    }
    
    /**
     * Include debug information
     */
    function renderDevMode (){  
        if (Service::get('config')['mode'] == 'dev') {
            include __DIR__.'/../../app/Resources/views/devpanel.html.php';
        }
    }
}
