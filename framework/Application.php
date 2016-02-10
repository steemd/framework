<?php
namespace Framework;

use Framework\Router\Router;

class Application {

    public function run() {
        $router = new Router(include('../app/config/routes.php'));

        $routeInfo = $router->parseRoute();

        if (is_array($routeInfo)) {
            echo '<pre>';
            print_r($routeInfo);
            echo '</pre>';
        } else {
            echo '<h2>404</h2>';
            echo '<p>No URLs faund in site.</p>';
        }
        
    }

}
