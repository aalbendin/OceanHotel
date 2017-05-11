<?php

namespace HotelBundle\TascaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use HotelBundle\Entity\TipusTasca;
use HotelBundle\Entity\Treballador;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class TascaController extends Controller
{
    public function indexAction(){
             $em = $this->getDoctrine()->getManager();
      $treb = $em->getRepository('HotelBundle:Treballador');
      $treballador = $treb->retornaTreballador();
      $tasques = $this->getDoctrine()->getRepository('HotelBundle:Tasca')->findBy(array('TipusTreballador' => $treballador->getTipusTreballador()->getId(),'Estat' => 1));

        return $this->render('HotelBundleTascaBundle:Default:llistaTreballadorTasca.html.twig', array(
                    'array' => $tasques
        ));
    }

    
}