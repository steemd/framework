<?php

namespace Framework\Controller;

use Framework\Renderer\Renderer;
use Framework\Response\Response;
use Framework\Response\RedirectResponse;
use Framework\DI\Service;
/**
 * Description of Controller
 *
 * @author steemd
 */
abstract class Controller {
    
    public function render($template, $data){
        $calledClassName = get_called_class();
        
        $renderer = new Renderer($template, $data, $calledClassName);
        $content = $renderer->getContent();
        
        return new Response($content);
    }
    
    public function redirect($url = '/'){
        return new RedirectResponse($url);
    }
    
    public function generateRoute($name){
        $routes = Service::get('routes');
        $url = $routes[$name]['pattern'];
        return $url;
    }
}
