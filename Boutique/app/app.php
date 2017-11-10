<?php

//app/app.phpinfo

use Symfony\Component\Debug\ErrorHandler;
use Symfony\Component\Debug\ExceptionHandler;

//Enregistrement des services : Error et Exception :
ErrorHandler::register();
ExceptionHandler::register();


//On enregistre notre application au service Doctrine qu'on a récupéré :
$app->register(new Silex\provider\DoctrineServiceProvider());

//On enregistre dans $app['dao.produit'] un objet de la classe ProduitDAO de manière à ce qu'il soit directement accessible via $app.
$app['dao.produit'] = function($app){
    return new BOUTIQUE\DAO\ProduitDAO($app['db']);
};

//On enregistre le srvice TWIG :
$app-> register(new Silex\Provider\TwigServiceProvider(), array('twig.path'=> __DIR__ . '/../views'
));


// On enregistre le service Assets :
$app->register(new Silex\Provider\AssetServiceProvider(), array(
    'assets.version'=> 'v1'

));

//On enregistre le service Form
$app->register(new Silex\Provider\FormServiceProvider()); 
