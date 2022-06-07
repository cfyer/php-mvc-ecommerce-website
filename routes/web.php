<?php

$router->map('GET', '/', 'HomeController@index', 'Home');
$router->map('POST', '/form/', 'HomeController@form', 'Form');