<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Controller\EventsController;
use App\Controller\IndexController;
use App\Controller\ProfileController;
use App\Controller\LoginController;
use App\Controller\RegisterController;
use App\Controller\AssetController;
use App\Routing\Exception\RouteNotFoundException;
use App\Routing\Route;
use App\Routing\Router;

$dbConfig = parse_ini_file(__DIR__ . '/../config/db.ini');

if ($dbConfig === false) {
    echo "Fichier de configuration de la base de données introuvable, créez un fichier db.ini dans config/ (voir README)";
    exit;
}

[
    'DB_HOST' => $host,
    'DB_PORT' => $port,
    'DB_NAME' => $dbName,
    'DB_CHARSET' => $charset,
    'DB_USER' => $user,
    'DB_PASSWORD' => $password
] = $dbConfig;

try {
    $dsn = "mysql:host=$host;port=$port;dbname=$dbName;charset=$charset";
    $pdo = new PDO($dsn, $user, $password);
    $GLOBALS['pdo'] = $pdo;
} catch (PDOException $e) {
    echo "Erreur lors de la connexion à la base de données" . $e->getMessage();
    exit;
}

$router = new Router();

$router
    ->addRoute(
        new Route('/img/{file}', 'images', 'GET', AssetController::class, 'images')
    )
    ->addRoute(
        new Route('/', 'home', 'GET', IndexController::class, 'home')
    )
    ->addRoute(
        new Route('/events', 'events', 'GET', EventsController::class, 'events')
    )
    ->addRoute(
        new Route('/login', 'login', 'GET', LoginController::class, 'login')
    )
    ->addRoute(
        new Route('/models/login.php', 'traitement_login', 'POST', LoginController::class, 'traitement_login')
    )
    ->addRoute(
        new Route('/register', 'register', 'GET', RegisterController::class, 'register')
    )
    ->addRoute(
        new Route('/process_register', 'process_register', 'POST', RegisterController::class, 'process_register')
    )
    ->addRoute(
        new Route('/verify-email/{token}', 'verify_email', 'GET', RegisterController::class, 'verify_email')
    );

[
    'REQUEST_URI' => $uri,
    'REQUEST_METHOD' => $httpMethod
] = $_SERVER;

try {
    echo $router->execute($uri, $httpMethod);
} catch (RouteNotFoundException) {
    http_response_code(404);
    echo "Page non trouvée";
} catch (Exception $e) {
    http_response_code(500);
    echo "Erreur interne, veuillez contacter l'administrateur" . $e->getMessage();
}
