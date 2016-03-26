<?php

namespace Framework\Router;

/**
 * Router is a main routing class in framework
 */
class Router {
    /**
     * @var array 
     */
    protected $routes;
    /**
     * Construct method save routes array
     * 
     * @param array $routes
     */
    function __construct($routes) {
        $this->routes = $routes;
    }
    /**
     * ParseRoute return correct route array
     * 
     * @return array
     */
    public function parseRoute(){
        $url = str_replace('/web', '', filter_input(INPUT_SERVER, 'REQUEST_URI'));
        preg_match("/[\w\d\/]+/", $url, $newUrl);
        $params = array();
        
        /* @var $route array */
        foreach ($this->routes as $key => $route){
            
            preg_match($this->getPattern($route), $newUrl[0], $resalt);
               
            if ($resalt[0]) {
                if ($this->getParamsName($route)){
                    $params[$this->getParamsName($route)] = $resalt[1];
                }
                $route['params'] = $params;
                $route['_name'] = $key;
                
                return $route;
            }
        }
    }
    /**
     * Build new route from current params
     * 
     * @param string $name
     * @param number $id
     * 
     * @return string
     */
    public function buildRoute($name, $id = NULL){
        if (is_null($id)){
            $url = $this->routes[$name]['pattern'];
        } else {
            $url = str_replace('{id}', $id, $this->routes[$name]['pattern']);
        }
        return $url;
    }
    /**
     * Create correct puttern to parseRoute() method
     * 
     * @param array $route
     * 
     * @return string
     */
    private function getPattern($route){
        preg_match('~\{([\d\w]+)\}~', $route['pattern'], $resalt);
        
        if ($resalt[0]){
            $pattern = str_replace($resalt[0], '('.$route['_requirements'][$resalt[1]].')', $route['pattern']);
        } else {
            $pattern = $route['pattern'];
        }
        
        $pattern = str_replace('/', '\/', $pattern);
        
        return '~^'.$pattern.'$~i';
    }
    /**
     * Return paramenters names
     * 
     * @param array $route
     * 
     * @return string
     */
    private function getParamsName($route) {
        preg_match('~\{([\d\w]+)\}~', $route['pattern'], $resalt);
        
        return $resalt[1];
    }
        
}