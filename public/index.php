<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Controller\AdminUserController;
use App\Controller\ErrorController;
use App\Controller\EventsController;
use App\Controller\IndexController;
use App\Controller\LoginController;
use App\Controller\FavorisController;
use App\Controller\ProfileController;
use App\Controller\MesFavorisController;
use App\Controller\MesReservationController;
use App\Controller\SuppressionFavorisController;
use App\Controller\SuppressionReservationController;
use App\Controller\LogoutController;
use App\Controller\RegisterController;
use App\Controller\AssetController;
use App\Controller\ReservationController;
use App\Controller\AddEventController;
use App\Controller\AdminEventController;
use App\Controller\NotifMailController;
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
        new Route('/', 'default', 'GET', IndexController::class, 'home')
    )
    ->addRoute(
        new Route('/home', 'home', 'GET', IndexController::class, 'home')
    )
    ->addRoute(
        new Route('/events', 'events', 'GET', EventsController::class, 'events')
    )
    ->addRoute(
        new Route('/login', 'login', 'GET', LoginController::class, 'login')
    )
    ->addRoute(
        new Route('/register', 'register', 'GET', RegisterController::class, 'register')
    )
    ->addRoute(
        new Route('/process_register', 'process_register', 'POST', RegisterController::class, 'process_register')
    )
    ->addRoute(
        new Route('/process_login', 'process_login', 'POST', LoginController::class, 'process_login')
    )
    ->addRoute(
        new Route('/process_logout', 'process_logout', 'GET', LogoutController::class, 'process_logout')
    )
    ->addRoute(
        new Route('/verify-email/{token}', 'verify_email', 'GET', RegisterController::class, 'verify_email')
    )
    ->addRoute(
        new Route('/admin_user', 'admin_user', 'GET', AdminUserController::class, 'admin_user')
    )
    ->addRoute(
        new Route('/edit_user', 'edit_user', 'GET', AdminUserController::class, 'edit_user')
    )
    ->addRoute(
        new Route('/process_editUser', 'processEditUser', 'GET', AdminUserController::class, 'processEditUser')
    )
    ->addRoute(
        new Route('/processUpdateUser', 'processUpdateUser', 'POST', AdminUserController::class, 'processUpdateUser')
    )
    ->addRoute(
        new Route('/reservation', 'process_reservation', 'GET', ReservationController::class, 'process_reservation')
    )
    ->addRoute(
        new Route('/addevent', 'addevent', 'GET', AddEventController::class, 'addevent')
    )
    ->addRoute(
        new Route('/process_addevent', 'process_addevent', 'POST', AddEventController::class, 'process_addevent')
    )
    ->addRoute(
        new Route('/favoris', 'process_favoris', 'GET', FavorisController::class, 'process_favoris')
    )
    ->addRoute(
        new Route('/mesreservation', 'mesreservation', 'GET', MesReservationController::class, 'mesreservation')
    )
    ->addRoute(
        new Route('/mesfavoris', 'mesfavoris', 'GET', MesFavorisController::class, 'mesfavoris')
    )
    ->addRoute(
        new Route('/add_user', 'process_add_user', 'GET', AdminUserController::class, 'add_user')
    )
    ->addRoute(
        new Route('/process_add_user', 'process_add_user', 'POST', AdminUserController::class, 'processAddUser')
    )
    ->addRoute(
        new Route('/error401', 'error401', 'GET', ErrorController::class, 'error401')
    )
    ->addRoute(
        new Route('/error403', 'error403', 'GET', ErrorController::class, 'error403')
    )
    ->addRoute(
        new Route('/suppressionfavoris', 'process_suppressionfavoris', 'GET', SuppressionFavorisController::class, 'process_suppressionfavoris')
    )
    ->addRoute(
        new Route('/suppressionreservation', 'process_suppressionreservation', 'GET', SuppressionReservationController::class, 'process_suppressionreservation')
    )
    ->addRoute(
        new Route('/admin_events', 'admin_events', 'GET', AdminUserController::class, 'admin_events')
    )
    ->addRoute(
        new Route('/edit_event', 'edit_event', 'GET', AdminEventController::class, 'edit_event')
    )
    ->addRoute(
        new Route('/process_editEvent', 'process_editEvent', 'GET', AdminEventController::class, 'process_editEvent')
    )
    ->addRoute(
        new Route('/processUpdateEvent', 'processUpdateEvent', 'POST', AdminEventController::class, 'processUpdateEvent')
    )
    ->addRoute(
        new Route('/profile', 'profile', 'GET', ProfileController::class, 'profile')
    )
    ->addRoute(
        new Route('/process_deleteUser', 'process_deleteUser', 'GET', AdminUserController::class, 'process_deleteUser')
    )
    ->addRoute(
        new Route('/delete_event', 'process_deleteEvent', 'GET', AdminEventController::class, 'process_deleteEvent')
    )
    ->addRoute(
        new Route('/notif_j1', 'notif_j1', 'GET', NotifMailController::class, 'notif_j1')
    );

[
    'REQUEST_URI' => $uri,
    //'PATH_INFO' => $uri,
    'REQUEST_METHOD' => $httpMethod
] = $_SERVER;

$parts = explode("?", $uri);
$uri = $parts[0];

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['role'])) {
    $_SESSION['role'] = 0;
}

try {
    echo $router->execute($uri, $httpMethod);
} catch (RouteNotFoundException) {
    http_response_code(404);
    echo "Page non trouvée";
} catch (Exception $e) {
    http_response_code(500);
    echo "Erreur interne, veuillez contacter l'administrateur" . $e->getMessage();
}
