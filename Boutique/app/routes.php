<?php

use Symfony\component\HttpFondation\Request;
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
$app->get('/', function() use($app){

    $produits = $app['dao.produit']-> findAll();
    //$produits = objetModelProduit (ProduitDAO)->findAll();
    //produits est un tableau multidimensionnel composé d'objet
    $categories = $app['dao.produit']->findAllCategories();

    //Mis en commentaire à l'étape 8.6
    // ob_start();
    // require'../views/view.php';
    // $view = ob_get_clean();
    // return $view;
    // });

    //Ajouté à l'etape 8.6 :


    $params = array(
        'produits'=> $produits,
        'categories'=> $categories,
        'title'=>'Accueil'
    );

    return $app['twig']->render('index.html.twig', $params) ;
})->bind('home');








$app->get('/produit/{id}', function($id) use($app){

    $produit = $app['dao.produit']->findById($id);

    // ob_start();
    // require '../views/view_idproduit.php';
    // $view_id = ob_get_clean();
    // return $view_id;
    $params = array(
        'produit'=>$produit,
        'title'=> 'Nos produits'
    );
    return $app['twig']->render('produit.html.twig',$params);

})->bind('produit');



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

$app->get('/profil', function() use($app){

    session_start();
    $_SESSION['membre']['prenom']= 'Yannick';
    $_SESSION['membre']['nom']='Bley';
    $_SESSION['membre']['pseudo']="Yannick";
    $_SESSION['membre']['email']="yannick.bley@lepoles.com";
    $_SESSION['membre']['adresse']="27, rue du haut de la noue";
    $_SESSION['membre']['code_postal']="92390";
    $_SESSION['membre']['ville']="Villeneuve-La-Garenne";
    $_SESSION['membre']['sexe']="M";
    $_SESSION['membre']['statut']="1";


    $params = array(
        'membre'=> $_SESSION['membre']
    );

    return $app['twig']->render('profil.html.twig', $params);
})->bind('profil');


//Fonctionnalité pour le formulaire de contact : /contact/

$app->match('/contact/', function(Request $request) use($app){
    $contactForm = $app['form.factory']->create(BOUTIQUE\Form\Type\ContactType::class);

$contactFormView = $contactForm->createView();

    $params = array(
     'title'=>'Formulaire Contact',
     'contactForm'=> $contactFormView
 );
 
return $app['twig']->render('contact.html.twig', $params);

})->bind ('contact');


//Etc...


//On rend la vue profil.html.twig
