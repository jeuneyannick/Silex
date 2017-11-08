<?php
// src/DAO/ProduitDAO.php

namespace BOUTIQUE\DAO;

use Doctrine\DBAL\Connection;
use BOUTIQUE\Entity\Produit;


class ProduitDAO
{
    private $db;// Va contenir notre objet Connection, qui representera la connexion à la BDD.
    public function __construct(Connection $db){
        $this->db = $db;
    }
    public function getDb(){
        return $this->db;
    }
    public function findAll(){
        //Fonction pour récupérer tous les produits dans la BDD :
        $requete = "SELECT * FROM produit";
        $resultat =  $this->getDb()-> fetchAll($requete);
        // $resultat : Contient toutes les produtis sous forme d'un array multidimensionnel
        $produits = array();
        foreach($resultat as $value){

            $id_produit = $value['id_produit'];
            $produits[$id_produit] = $this->buildProduit($value);
        }
        return $produits;

    }

    public function findAllCategories(){
        $req= "SELECT DISTINCT categorie FROM produit";
        $resultat = $this->getDb()-> fetchAll($req);

        return $resultat; // est un tableau multidimensionnel avec toutes les categories...
    }

 // Toutes les autres requetes de l'entité Produit seront ici.




protected function buildProduit(array $value){//l'objectif de cette fonction est de transformer un array contenant toutes les infos d'un produit en un objet de la classe Entity/Produit.
    $produit = new Produit;// Notre POPO qu'on a créé avec des getter et des setter.
    $produit->setId_Produit($value['id_produit']);
    $produit->setReference($value['reference']);
    $produit->setCategorie($value['categorie']);
    $produit->setTitre($value['titre']);
    $produit->setDescription($value['description']);
    $produit->setCouleur($value['couleur']);
    $produit->setTaille($value['taille']);
    $produit->setPublic($value['public']);
    $produit->setPhoto($value['photo']);
    $produit->setPrix($value['prix']);
    $produit->setStock($value['stock']);

    return $produit;

    //On a transformé un array qui contient toutes les infos d'un produit en un objet qui contient toutes les infos du produit et on a renvoyé cet objet ensuite :)
  }
}
