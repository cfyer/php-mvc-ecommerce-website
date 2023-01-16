<?php
session_start();

use App\Core\{Database, ErrorHandler, RouteHandler};

define('BASE_PATH', realpath(__DIR__ . '/../../'));

require_once  BASE_PATH . "/vendor/autoload.php";

require_once  BASE_PATH . "/app/config/_env.php";

new ErrorHandler;

new Database;

$router = new AltoRouter();
require_once BASE_PATH . "/routes/web.php";
try {
    new RouteHandler($router);
} catch (Exception $e) {
    echo $e->getMessage();
}