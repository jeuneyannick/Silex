<?php

namespace BOUTIQUE\Controller;
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use BOUTIQUE\Entity\Produit;


class BaseController
{
    public function produitAction(Application $app){
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

        })
    }

    public function contactAction(Request $request){

    }


}
