<?php

namespace HotelBundle\UsuariBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
    	$usuari = $this->getDoctrine()->getRepository('HotelBundle:User')->findAll();
    	/*var_dump($usuari); exit();*/
        return $this->render('HotelBundleUsuariBundle:Default:llista.html.twig', array(
                    'array' => $usuari
        ));
    }
}
