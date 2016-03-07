<?php

namespace Framework\Renderer;

use Framework\DI\Service;

/**
 * Renderer is uisng to return correct content to App
 *
 * @author steemd
 */
class Renderer {

    /**
     * @var mixed $template
     * @var array $date
     */
    private $layoutUrl;
    private $templateUrl;
    private $data;

    function __construct($template, $data = array(), $className) {
        $config = Service::get('config');
        $viewNameDir = str_replace('Controller', '', str_replace('Blog\\Controller\\', '', $className));

        $this->templateUrl =  __DIR__.'/../../src/Blog/views/'.$viewNameDir.'/'.$template.'.php';
        //$this->templateUrl = __DIR__ . '/../../src/Blog/views/Post/' . $template . '.php';
        $this->data = $data;
        $this->layoutUrl = $config['main_layout'];
    }

    public function getContent() {

        extract($this->data);

        $include = function($controllerName, $actionName, $date = array()) {
            echo 'Run Include function';
        };

        ob_start();
        include $this->templateUrl;
        $content = ob_get_contents();
        ob_end_clean();

        $resalt  = $this->getMainContent($content);
        
        return $resalt;
    }
    
    public function getMainContent($content){
        $route = Service::get('route');
        
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
