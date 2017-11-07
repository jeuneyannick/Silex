<?php

$app->get('/', function(){
    require '../src/model.php';
    //Fichier qui contient notre focntion afficheAll()

    $infos = afficheAll();

    $produits = $infos['produits'];
    $categories = $infos['categories'];

    ob_start(); // Enclenche la temporisation. Cela signifie que tout ce qui suit ne sera pas execuuté
    require '../views/view.php';
    $view = ob_get_clean(); //Stocke tout de qui a été retenu dans une variable
    return $view;

    // Ici on a stocké notre vue dans la variable $view grâce à ob_start et ob_get_clean(), ensuite on retourne la vue.
    //C'est la base de la fonction render() qu'on utilisera par la suite.

});
