<?php

function afficheAll()
{
    $pdo = new PDO('mysql:host=localhost;dbname=site','root', '');

    $req= $pdo->query("SELECT * FROM produit");
    $produits = $req->fetchAll(PDO::FETCH_ASSOC);

    $req= $pdo->query("SELECT DISTINCT categorie FROM produit");
    $categories = $req->fetchAll(PDO::FETCH_ASSOC);

    $infos = array (
        "produits" => $produits,
        "categories"=> $categories
    );

    return $infos; // on ne peut faire qu'un return


}
