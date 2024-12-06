<?php
session_start();

require_once '../app/config/config.php';
require_once '../app/config/database.php';

// Fonction de chargement automatique des classes
spl_autoload_register(function ($class_name) {
    // Charger les contrôleurs uniquement si le fichier existe
    $controller_file = __DIR__ . '/../app/Controllers/' . $class_name . '.php';
    if (file_exists($controller_file)) {
        require_once $controller_file;
    }

    // Charger les modèles uniquement si le fichier existe
    $model_file = __DIR__ . '/../app/Models/' . $class_name . '.php';
    if (file_exists($model_file)) {
        require_once $model_file;
    }
});

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

// Définir les routes
if ($uri === '/project/public/' && $method === 'GET') {
    $controller = new HomeController();
    $controller->index();
} elseif ($uri === '/project/public/login' && $method === 'GET') {
    $controller = new UserController();
    $controller->login();
} elseif ($uri === '/project/public/login' && $method === 'POST') {
    $controller = new UserController();
    $controller->login();
} elseif ($uri === '/project/public/register' && $method === 'GET') {
    $controller = new UserController();
    $controller->register();
} elseif ($uri === '/project/public/register' && $method === 'POST') {
    $controller = new UserController();
    $controller->register();
} elseif ($uri === '/project/public/profile' && $method === 'GET') {
    $controller = new UserController();
    $controller->profile();
} elseif ($uri === '/project/public/hero/create' && $method === 'GET') {
    $controller = new HeroController();
    $controller->create();
} elseif ($uri === '/project/public/hero/create' && $method === 'POST') {
    $controller = new HeroController();
    $controller->create();
} elseif ($uri === '/project/public/quest/start' && $method === 'GET') {
    if (isset($_GET['hero_id'])) {
        $heroId = $_GET['hero_id'];
        echo "Route: /quest/start<br>";
        $controller = new QuestController();
        $controller->start($heroId);
    } else {
        echo "Hero ID missing<br>";
    }
} elseif ($uri === '/project/public/quest/start' && $method === 'POST') {
    $controller = new QuestController();
    $controller->start();
} elseif ($uri === '/project/public/quest/progress' && $method === 'GET') {
    if (isset($_GET['quest_id'])) {
        $questId = $_GET['quest_id'];
        echo "Route: /quest/progress<br>";
        $controller = new QuestController();
        $controller->progress($questId);
    } elseif (isset($_GET['chapter_id'])) {
        $chapterId = $_GET['chapter_id'];
        echo "Route: /quest/progress<br>";
        $controller = new QuestController();
        $controller->progress($chapterId);
    } else {
        echo "Quest ID or Chapter ID missing<br>";
    }
} elseif ($uri === '/project/public/battle' && $method === 'GET') {
    $controller = new BattleController();
    $controller->index();
} elseif ($uri === '/project/public/battle/result' && $method === 'POST') {
    $controller = new BattleController();
    $controller->result();
} elseif (preg_match('/^\/project\/public\/hero\/stats\/(\d+)$/', $uri, $matches) && $method === 'GET') {
    $heroId = $matches[1];
    echo "Route: /hero/stats/$heroId<br>";
    $controller = new HeroController();
    $controller->show($heroId);
} elseif ($uri === '/project/public/logout' && $method === 'GET') {
    echo "Route: /logout<br>";
    session_destroy();
    header('Location: /project/public/login');
    exit;
} else {
    header('HTTP/1.0 404 Not Found');
    echo 'Page non trouvée';
}
?>
