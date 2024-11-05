<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'autoload.php';

class Router {
    private $routes = [];
    private $prefix;

    public function __construct($prefix = '') {
        $this->prefix = trim($prefix, '/');
    }

    public function addRoute($uri, $controllerMethod) {
        $this->routes[trim($uri, '/')] = $controllerMethod;
    }

    public function route($url) {
        if($this->prefix && strpos($url, $this->prefix) === 0) {
            $url = substr($url, strlen($this->prefix));
        }

        $url = trim($url, '/');

        if(array_key_exists($url, $this->routes)) {
            list($controllerName, $methodName) = explode('@', $this->routes[$url]);

            $controller = new $controllerName();
            $controller->$methodName();
        } else {
            echo '<h2>L\'URL demandée n\'existe pas</h2>';
        }
    }
}

$router = new Router('DungeonXplorer');

// Ajout des routes
$router->addRoute('accueil', 'HomeController@index');

// Appel de la méthode route
$router->route(trim($_SERVER['REQUEST_URI'], '/'));