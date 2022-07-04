<?php

/**
 * ========== Client Rotues ==========
 */
$router->map('GET', '[/]?', 'HomeController@index');

# products
$router->map('GET', '/products/[i:id][/]?', 'ProductController@show');
$router->map('GET', '/products[/]?', 'ProductController@index');

# categories
$router->map('GET', '/categories/[i:id][/]?', 'CategoryController@show');

# cart
$router->map('GET', '/cart[/]?', 'CartController@show');
$router->map('POST', '/cart/add/', 'CartController@addItem');
$router->map('POST', '/cart/quantity/inc/', 'CartController@incQty');
$router->map('POST', '/cart/quantity/dec/', 'CartController@decQty');
$router->map('POST', '/cart/remove/item/', 'CartController@removeItem');
$router->map('POST', '/cart/remove/all/', 'CartController@removeAll');

# auth
$router->map('GET', '/register[/]?', 'AuthController@register');
$router->map('POST', '/register/', 'AuthController@registerOperate');
$router->map('GET', '/login[/]?', 'AuthController@login');
$router->map('POST', '/login/', 'AuthController@loginOperate');
$router->map('POST', '/logout/', 'AuthController@logout');

# payment
$router->map('POST', '/payment/pay/', 'Payment\PaymentController@pay');
$router->map('POST', '/payment/callback/', 'Payment\PaymentController@callback');

/**
 * ========== Adming Panel Routes ==========
 */
$router->map('GET', '/admin[/]?', 'Admin\DashboardController@index');

# categories
$router->map('GET', '/admin/categories[/]?', 'Admin\CategoryController@index');
$router->map('POST', '/admin/categories/store/', 'Admin\CategoryController@store');
$router->map('GET', '/admin/categories/[i:id]/edit/', 'Admin\CategoryController@edit');
$router->map('POST', '/admin/categories/[i:id]/update/', 'Admin\CategoryController@update');
$router->map('POST', '/admin/categories/[i:id]/delete/', 'Admin\CategoryController@delete');

# products
$router->map('GET', '/admin/products[/]?', 'Admin\ProductController@index');
$router->map('GET', '/admin/products/create[/]?', 'Admin\ProductController@create');
$router->map('POST', '/admin/products/store/', 'Admin\ProductController@store');
$router->map('GET', '/admin/products/[i:id]/edit/', 'Admin\ProductController@edit');
$router->map('POST', '/admin/products/[i:id]/update/', 'Admin\ProductController@update');
$router->map('POST', '/admin/products/[i:id]/delete/', 'Admin\ProductController@delete');

# sldier
$router->map('GET', '/admin/slider[/]?', 'Admin\SliderController@index');
$router->map('GET', '/admin/slider/create[/]?', 'Admin\SliderController@create');
$router->map('POST', '/admin/slider/store/', 'Admin\SliderController@store');
$router->map('POST', '/admin/slider/[i:id]/delete/', 'Admin\SliderController@delete');
$router->map('GET', '/admin/slider/[i:id]/active/', 'Admin\SliderController@activeSwitch');

# users 
$router->map('GET', '/admin/users[/]?', 'Admin\UserController@index');
$router->map('GET', '/admin/users/[i:id]/edit[/]?', 'Admin\UserController@edit');
$router->map('POST', '/admin/users/[i:id]/update/', 'Admin\UserController@update');
$router->map('POST', '/admin/users/[i:id]/delete/', 'Admin\UserController@delete');

# payments
$router->map('GET', '/admin/payments[/]?', 'Admin\PaymentController@index');

# orders
$router->map('GET', '/admin/orders[/]?', 'Admin\OrderController@index');
