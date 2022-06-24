<?php
session_start();

use App\Core\Database;
use App\Core\ErrorHandler;
use App\Core\RouteHandler;

define('BASE_PATH', realpath(__DIR__ . '/../../'));

require_once  BASE_PATH . "/vendor/autoload.php";

require_once  BASE_PATH . "/app/config/_env.php";

new ErrorHandler;

new Database;

$router = new AltoRouter();
require_once BASE_PATH . "/routes/web.php";
new RouteHandler($router);

