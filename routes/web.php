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

# products
$router->map('GET', '/admin/products[/]?', 'Admin\ProductController@index', 'products');
$router->map('GET', '/admin/products/create[/]?', 'Admin\ProductController@create', 'products.create');
$router->map('POST', '/admin/products/store/', 'Admin\ProductController@store', 'products.store');
$router->map('GET', '/admin/products/[i:id]/edit/', 'Admin\ProductController@edit', 'products.edit');
$router->map('POST', '/admin/products/[i:id]/update/', 'Admin\ProductController@update', 'products.update');
$router->map('POST', '/admin/products/[i:id]/delete/', 'Admin\ProductController@delete', 'products.delete');