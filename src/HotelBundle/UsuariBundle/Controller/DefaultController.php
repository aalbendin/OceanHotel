<?php

namespace HotelBundle\UsuariBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction(){
    	$usuari = $this->getDoctrine()->getRepository('HotelBundle:User')->findAll();
        return $this->render('HotelBundleUsuariBundle:Default:llista.html.twig', array(
                    'array' => $usuari
        ));
    }


}
