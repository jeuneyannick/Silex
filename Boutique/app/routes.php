<?php

use Symfony\Component\HttpFoundation\Request;
// Request est la classe Symfony qui va gérer les requetes HTTPS (POST). On ne récupère les infos qu'avec $_POST directement

//Crée en etape 6.3
//Commenté en étape 7.9


// $app->get('/', function(){
//    require '../src/model.php';
//
// $app->get('/', function(){
//     require '../src/model.php';
//Fichier qui contient notre fonction afficheAll()

// $app->get('/', function(){
//    require '../src/model.php';

//     //Fichier qui contient notre focntion afficheAll()
//
//     $infos = afficheAll();
//
//     $produits = $infos['produits'];
//     $categories = $infos['categories'];
//
//     ob_start(); // Enclenche la temporisation. Cela signifie que tout ce qui suit ne sera pas execuuté
//     require '../views/view.php';
//     $view = ob_get_clean(); //Stocke tout de qui a été retenu dans une variable
//     return $view;
//
//     // Ici on a stocké notre vue dans la variable $view grâce à ob_start et ob_get_clean(), ensuite on retourne la vue.
//     //C'est la base de la fonction render() qu'on utilisera par la suite.


// });

//
// $produits = $infos['produits'];
// $categories = $infos['categories'];
//
// ob_start(); // Enclenche la temporisation. Cela signifie que tout ce qui suit ne sera pas execuuté
// require '../views/view.php';
// $view = ob_get_clean(); //Stocke tout ce qui a été retenu dans une variable
// return $view;

// Ici on a stocké notre vue dans la variable $view grâce à ob_start et ob_get_clean(), ensuite on retourne la vue.
//C'est la base de la fonction render() qu'on utilisera par la suite.

$app->get('/', "BOUTIQUE\Controller\BaseController::indexAction")->bind('home');

$app->get('/', "BOUTIQUE\Controller\ProduitController::produitAction")->bind('produit');

// Route pour l'affichage de tous les produits dans le backoffice (dans un tableau HTML)
$app->get('/backoffice/produit/',"BOUTIQUE\Controller\BackOfficeController::produitAction")->bind('bo_produit');

//On souhaite construire une nouvelle fonctionnalité (nouvelle route) qui va nous afficher tous les produits en fonction de la catégorie.
//L'URL souhaitée est : www.boutique.dev/boutique/nom_de_la_categorie

$app->get('/boutique/{categorie}',function($categorie) use($app){

    //Etape1: récupérer les produits en fonction de $categorie
    // SELECT * FROM produit WHERE categorie = '$categorie'
    //Etape3: On affiche la bonne vue.

    $produits = $app['dao.produit']->findAllByCategorie($categorie);



    $categories = $app['dao.produit']->findAllCategories();// Etape 2 Récupérer egalement toutes catégories pour ré-afficher le menu latéral.

    $params = array(
        'produits'=> $produits,
        'categories'=>$categories,
        'title'=> 'Nos '. $categorie .'s'
    );

    return $app['twig']->render('index.html.twig', $params);

})->bind('boutique');
// ob_start();
// require'../views/view.php';
// $view = ob_get_clean();
// return $view;

//
//  $produits = $app['dao.produit']-> findAll();
//  //$produits = objetModelProduit (ProduitDAO)->findAll();
// // //produits est un tableau multidimensionnel composé d'objet
// $categories = $app['dao.produit']->findAllCategories();
// //
// //
//  ob_start();
//  require'../views/view.php';
// $view = ob_get_clean();
// return $view;
// //
// // });

// exo: Faire la route qui va afficher la page de profil. En simulant à l'intérieur de la route l'ouverture de la session, et en enregistrant dans $_SESSION['membre'] les infos d'un membre au hasard.

$app->get('/', "BOUTIQUE\Controller\MembreController::profilAction")->bind('profil');


//Fonctionnalité pour le formulaire de contact : /contact/

$app->get('/',"BOUTIQUE\Controller\BaseController::contactAction")->bind('contact');


$app->match('/backoffice/produit/add/', 'BOUTIQUE\Controller\BackOfficeController::addProduitAction')->bind('bo_produit_add'); 
//Etc...


//On rend la vue profil.html.twig
