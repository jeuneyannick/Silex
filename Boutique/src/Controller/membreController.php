<?php

namespace BOUTIQUE\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

class MembreController
{
   public function profilAction($id, Application $app ()
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

}













 ?>
