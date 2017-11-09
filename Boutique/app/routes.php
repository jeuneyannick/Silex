<?php
//Crée en etape 6.3
//Commenté en étape 7.9

<<<<<<< HEAD
// $app->get('/', function(){
//    require '../src/model.php';
=======
<<<<<<< HEAD
$app->get('/', function(){
    require '../src/model.php';
    //Fichier qui contient notre fonction afficheAll()
=======
 // $app->get('/', function(){
 //    require '../src/model.php';
>>>>>>> 15ab289201810f4612755bb750f59f63cb8e5f62
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
<<<<<<< HEAD
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

    return $app['twig']->render('index.html.twig', $params);
});








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
    
});


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
    // ob_start();
    // require'../views/view.php';
    // $view = ob_get_clean();
    // return $view;

=======
$produits = $app['dao.produit']-> findAll();
//$produits = objetModelProduit (ProduitDAO)->findAll();
//produits est un tableau multidimensionnel composé d'objet
$categories = $app['dao.produit']->findAllCategories();
>>>>>>> cfdec698788e459883f40334f2d88eeaffcd41c4

ob_start();
require'../views/view.php';
$view = ob_get_clean();
return $view;
>>>>>>> 15ab289201810f4612755bb750f59f63cb8e5f62
});
