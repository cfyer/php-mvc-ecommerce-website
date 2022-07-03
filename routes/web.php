<?php

/**
 * ======= Client Rotues =======
 */
$router->map('GET', '[/]?', 'HomeController@index', 'home');

# products
$router->map('GET', '/products/[i:id][/]?', 'ProductController@show', 'products.show');
$router->map('GET', '/products[/]?', 'ProductController@index', 'products.index');

# categories
$router->map('GET', '/categories/[i:id][/]?', 'CategoryController@show', 'categories.show');

# cart
$router->map('GET', '/cart[/]?', 'CartController@show', 'cart.show');
$router->map('POST', '/cart/add/', 'CartController@addItem', 'cart.add');
$router->map('POST', '/cart/quantity/inc/', 'CartController@incQty', 'cart.quantity.inc');
$router->map('POST', '/cart/quantity/dec/', 'CartController@decQty', 'cart.quantity.dec');
$router->map('POST', '/cart/remove/item/', 'CartController@removeItem', 'cart.remove.item');
$router->map('POST', '/cart/remove/all/', 'CartController@removeAll', 'cart.remove.all');

# auth
$router->map('GET', '/register[/]?', 'AuthController@register', 'auth.register');
$router->map('POST', '/register/', 'AuthController@registerOperate', 'auth.register.operate');
$router->map('GET', '/login[/]?', 'AuthController@login', 'auth.login');
$router->map('POST', '/login/', 'AuthController@loginOperate', 'auth.login.operate');
$router->map('POST', '/logout/', 'AuthController@logout', 'auth.logout');

# payment
$router->map('POST', '/payment/pay/', 'Payment\PaymentController@pay', 'payment.pay');
$router->map('POST', '/payment/callback/', 'Payment\PaymentController@callback', 'payment.callback');

/**
 * ======= Adming Panel Routes =======
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

# sldier
$router->map('GET', '/admin/slider[/]?', 'Admin\SliderController@index', 'slider');
$router->map('GET', '/admin/slider/create[/]?', 'Admin\SliderController@create', 'slider.create');
$router->map('POST', '/admin/slider/store/', 'Admin\SliderController@store', 'slider.store');
$router->map('POST', '/admin/slider/[i:id]/delete/', 'Admin\SliderController@delete', 'slider.delete');
$router->map('GET', '/admin/slider/[i:id]/active/', 'Admin\SliderController@activeSwitch', 'slider.active');

# users 
$router->map('GET', '/admin/users[/]?', 'Admin\UserController@index', 'user');
$router->map('GET', '/admin/users/[i:id]/edit[/]?', 'Admin\UserController@edit', 'user.edit');
$router->map('POST', '/admin/users/[i:id]/update/', 'Admin\UserController@update', 'user.update');
$router->map('POST', '/admin/users/[i:id]/delete/', 'Admin\UserController@delete', 'user.delete');