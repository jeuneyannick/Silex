<?php
//Crée en etape 6.3
//Commenté en étape 7.9

<<<<<<< HEAD
$app->get('/', function(){
    require '../src/model.php';
    //Fichier qui contient notre fonction afficheAll()
=======
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
>>>>>>> cfdec698788e459883f40334f2d88eeaffcd41c4

// });

<<<<<<< HEAD
    $produits = $infos['produits'];
    $categories = $infos['categories'];

    ob_start(); // Enclenche la temporisation. Cela signifie que tout ce qui suit ne sera pas execuuté
    require '../views/view.php';
    $view = ob_get_clean(); //Stocke tout ce qui a été retenu dans une variable
    return $view;

    // Ici on a stocké notre vue dans la variable $view grâce à ob_start et ob_get_clean(), ensuite on retourne la vue.
    //C'est la base de la fonction render() qu'on utilisera par la suite.
=======
$app->get('/', function() use($app){
$produits = $app['dao.produit']-> findAll();
//$produits = objetModelProduit (ProduitDAO)->findAll();
//produits est un tableau multidimensionnel composé d'objet
$categories = $app['dao.produit']->findAllCategories();
>>>>>>> cfdec698788e459883f40334f2d88eeaffcd41c4

ob_start();
require'../views/view.php';
$view = ob_get_clean();
return $view;
});
