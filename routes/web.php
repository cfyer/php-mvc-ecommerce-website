<?php

/**
 * Client Rotues
 */
$router->map('GET', '/', 'HomeController@index', 'home');

/**
 * Adming Panel Routes
 */
$router->map('GET', '/admin[/]?', 'Admin\DashboardController@index', 'dashboard');

# categories
$router->map('GET', '/admin/categories[/]?', 'Admin\CategoryController@index', 'categories');
$router->map('POST', '/admin/categories/store/', 'Admin\CategoryController@store', 'categories.store');
$router->map('GET', '/admin/categories/[i:id]/edit/', 'Admin\CategoryController@edit', 'categories.edit');
$router->map('POST', '/admin/categories/[i:id]/update/', 'Admin\CategoryController@update', 'categories.update');
$router->map('POST', '/admin/categories/[i:id]/delete/', 'Admin\CategoryController@delete', 'categories.delete');
