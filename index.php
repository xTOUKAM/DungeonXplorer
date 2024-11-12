<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once 'views/home.php';

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

    public function route($url)
    {
        // Récupérer les paramètres GET
        if (isset($_GET['controller']) && isset($_GET['action'])) {
            $chapterId = $_GET['chapterId'] ?? null;  // Peut être null si non défini
            $controllerName = $_GET['controller'] ?? 'HomeController';
            $action = $_GET['action'] ?? 'index';
            
            // Inclure et créer le contrôleur
            require_once "controllers/{$controllerName}.php";
            $controller = new $controllerName();
            
            // Vérifier si la méthode existe, et l'appeler
            if (method_exists($controller, $action)) {
                // Appeler l'action avec le chapitre
                $controller->$action($chapterId);
            } else {
                echo "L'action demandée n'existe pas.";
            }
        } else {
            echo "Contrôleur ou action non définis.";
        }
    }   
}

// Instanciation du routeur
$router = new Router('DungeonXplorer');

// Ajout des routes
$router->addRoute('views/home', 'HomeController@index');
$router->addRoute('chapter/show', 'ChapterController@show');
$router->addRoute('chapter/choose', 'ChapterController@choose');

// Appel de la méthode route
$router->route(trim($_SERVER['REQUEST_URI'], '/'));

?>
