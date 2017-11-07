<?php

require_once __DIR__ .'/../vendor/autoload.php';

$app = new Silex\Application;

// $app->get('/', function(){
//
//
// return 'Hello World';
//
//
// });

// $app->get('/hello/{name}', function($name) use ($app){
//      return 'Hello' . $app-> escape($name);

$app['debug'] = true;
require __DIR__ . '/../app/routes.php';

// });

//http://localhost/silex/boutique/web/index.php/hello/Yakine

$app->run();
