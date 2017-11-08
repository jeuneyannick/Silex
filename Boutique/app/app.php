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
