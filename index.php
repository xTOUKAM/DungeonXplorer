<?php

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    require 'autoload.php';

    class Router
    {
        private $routes = [];
        private $prefix;

        public function __construct($prefix = '')
        {
            $this->prefix = trim($prefix, '/');
        }

        public function addRoute($uri, $controllerMethod)
        {
            $this->routes[trim($uri, '/')] = $controllerMethod;
        }

        public function route($url) {
            // Suppression du préfixe du début de l'URL
            if ($this->prefix && strpos($url, $this->prefix) === 0) {
                $url = substr($url, strlen($this->prefix) + 1);
            }

            $url = trim($url, '/');

            if (array_key_exists($url, $this->routes)) {
                // Extraction du nom du contrôleur et de la méthode
                list($controllerName, $methodName) = explode('@', $this->routes[$url]);

                // Instanciation du contrôleur et appel de la méthode
                $controller = new $controllerName();
                $controller->$methodName();
            } else {
                // Gestion des erreurs (page 404, etc.)
                echo '<h2>L\'URL demandée n\'existe pas !</h2>';
            }
        }
    }

    // Instanciation du routeur
    $router = new Router('DungeonXplorer');

    // Ajout des routes
    $router->addRoute('', 'HomeController@index');

    $router->addRoute('chapter/show', 'ChapterController@show');
    $router->addRoute('chapter/choose', 'ChapterController@choose');

    // Appel de la méthode route
    $router->route(trim($_SERVER['REQUEST_URI'], '/'));

    // index.php
    if (isset($_GET['controller']) && isset($_GET['action'])) {
        $controllerName = $_GET['controller'];
        $action = $_GET['action'];
        $chapterId = $_GET['chapterId'] ?? 1;

        // Charge le contrôleur
        require_once "controllers/{$controllerName}.php";
        $controller = new $controllerName();

        // Appelle l'action
        if (method_exists($controller, $action)) {
            $controller->$action($chapterId);
        } else {
            echo "Action non trouvée.";
        }
    } else {
        echo "Contrôleur ou action non définis.";
    }
?>