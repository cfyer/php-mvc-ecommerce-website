<?php
session_start();

define('BASE_PATH', realpath( __DIR__ . '/../../'));

require_once  BASE_PATH . "/vendor/autoload.php";

require_once  BASE_PATH . "/app/config/_env.php";