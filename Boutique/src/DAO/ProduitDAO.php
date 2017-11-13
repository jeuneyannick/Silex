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

    public function findById($id){
        //Fonction pour récupérer un produit dans la BDD :

        $req = "SELECT * FROM produit WHERE id_produit = ?";
        $resultat = $this->getDb()->fetchAssoc($req, array($id));
        // $resultat : Contient toutes les infos du produit sous forme d'un array

        $produit = $this->buildProduit($resultat);
        // On transforme en objet et on retourne cet objet
        return $produit;
    }
    // Toutes les autres requetes de l'entité Produit seront ici.

    public function findAllByCategorie($categorie){
        $req = "SELECT  * FROM produit WHERE categorie";
        $resultat = $this->getDb()->fetchAll($req, array($categorie));
        //$resulat = Array multidimensionnel composé d'array.

        $produits = array();
        foreach($resultat as $value){
            $id_produit = $value['id_produit'];
            $produits['id produit'] = $this->buildProduit($value);
        }

        return $produits;
        // $Produits est maintenant un array multi composé d'autant d'objets
    }


    protected function buildProduit(array $value){
        //l'objectif de cette fonction est de transformer un array contenant toutes les infos d'un produit en un objet de la classe Entity/Produit.
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

     public function save(Produit $produit){
         $produitData = array(
            'reference'=> $produit->getReference(),
            'categorire'=> $produit->getCategories(),
            'titre'=> $produit->getTitre(),
            'description'=> $produit->getDescription(),
            'public'=> $produit->getPublic(),
            'prix'=> $produit->getPrix(),
            'taille'=> $produit->getTaille(),
            'couleur'=> $produit->getCouleur(),
            'photo'=> 'test.png'
         );

         if($produit->getId_produit()){
             //Update
             $this->getDb()->update('produit', $produitData, array('id_produit'=>$produit->getId_produit()));
         } else {
             //Ajout de Produit
             $this->getDb->insert('produit', $produitData);
         }

     }


}
