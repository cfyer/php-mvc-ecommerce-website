<?php

/**
 * Client Rotues
 */
$router->map('GET', '/', 'HomeController@index', 'home');

/**
 * Adming Panel Routes
 */
$router->map('GET', '/admin/', 'Admin\DashboardController@index', 'dashboard');
