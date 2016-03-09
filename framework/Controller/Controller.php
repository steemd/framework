<?php

namespace Framework\Controller;

use Framework\Renderer\Renderer;
use Framework\Response\Response;
use Framework\Request\Request;
use Framework\Response\RedirectResponse;
use Framework\DI\Service;

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
    public function render($template, $data){
        $calledClassName = get_called_class();
        
        $renderer = new Renderer($template, $data, $calledClassName);
        $content = $renderer->getContent();
        
        return new Response($content);
    }
    
    /**
     * Return RedirectResponse object
     * 
     * @param string $url
     * 
     * @return RedirectResponse
     */
    public function redirect($url = '/'){
        return new RedirectResponse($url);
    }
    
    /**
     * Return Route name
     * 
     * @param type $name
     * 
     * @return string $url
     */
    public function generateRoute($name){
        $routes = Service::get('routes');
        $url = $routes[$name]['pattern'];
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
