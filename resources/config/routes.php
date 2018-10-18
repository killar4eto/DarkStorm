<?php
$routes = array();

/*
 * Route example
 * 
 * $routes[METHOD][URI_ROUTE] = TARGET;
 * 
 * METHOD can be GET, POST, PUT, DELETE
 * 
 * In the URI_ROUTE you can use regular expressions 
 * for example
 * --------------- /URI_ROUTE/regxp
 * $routes['GET']['/word/(\d+)'] = function($word)
 * {
 *      echo 'Your world is ' . $word;
 * };
 * 
 * TARGET can be a class or a function 
 * Above example uses anonymous function
 * The class has to be formated like
 * Namespace\Class@action
 * @ is required
 * 
 */

// GET
$routes['GET']['/'] = 'App\\Controllers\\Home@index';
$routes['GET']['/features'] = 'App\\Controllers\\Features@index';
$routes['GET']['/pictures'] = 'App\\Controllers\\Pictures@index';
$routes['GET']['/pictures/(\d+)'] = 'App\\Controllers\\Pictures@show';
$routes['GET']['/pictures/create'] = 'App\\Controllers\\Pictures@create';
$routes['GET']['/pictures/edit/(\d+)'] = 'App\\Controllers\\Pictures@edit';

$routes['GET']['/language/(\w+)'] = 'App\\Controllers\\Home@language';

$routes['GET']['/hello/(.*)'] = function($name)
{
    echo 'Hello, ' . $name;
};

// POST
$routes['POST']['/pictures'] = 'App\\Controllers\\Pictures@store';

// PUT
$routes['PUT']['/pictures/(\d+)'] = 'App\\Controllers\\Pictures@update';

// POST
$routes['DELETE']['/pictures/(\d+)'] = 'App\\Controllers\\Pictures@delete';

return $routes;