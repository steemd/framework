<?php

namespace Framework\Controller;

use Framework\Renderer\Renderer;
use Framework\Response\Response;
use Framework\Request\Request;
use Framework\Response\ResponseRedirect;
use Framework\DI\Service;
use Framework\Session\Session;

/**
 * Use to provide data and objects to users COntrollers
 *
 * @author steemd
 */
abstract class Controller {
    
    /**
     * Return Response object with contents
     * 
     * @param string $template
     * @param array $data
     * 
     * @return Response
     */
    public function render($template, $data = array()){
        $calledClassName = get_called_class();
        
        $renderer = new Renderer($template, $data, $calledClassName);
        $content = $renderer->renderContent();
        
        return new Response($content);
    }
    
    /**
     * Return RedirectResponse object
     * 
     * @param string $url
     * 
     * @return RedirectResponse
     */
    public function redirect($url = '/', $msg = ''){
        
        if($msg !== ''){
            Session::set('flash', $msg);
        }
        
        return new ResponseRedirect($url);
    }
    
    /**
     * Return Route name
     * 
     * @param type $name
     * 
     * @return string $url
     */
    public function generateRoute($name, $id = null){
        $routes = Service::get('routes');
        $url = $routes[$name]['pattern'];
        
        if(!is_null($id)){
            $url = str_replace('{id}', $id, $url);
        }
        
        return $url;
    }
    
    /**
     * Return Request object
     * 
     * @return Request
     */
    public function getRequest(){
        return new Request();
    }
}
