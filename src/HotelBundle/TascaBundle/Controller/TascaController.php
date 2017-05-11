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
      $container= $this->container;
      $em = $this->getDoctrine()->getManager();
      $treb = $em->getRepository('HotelBundle:Treballador');
      $treballador = $treb->retornaTreballador($container);
      $tasques = $this->getTasques($treballador);

        return $this->render('HotelBundleTascaBundle:Default:llistaTreballadorTasca.html.twig', array(
                    'array' => $tasques
        ));
    }

    public function getTasques(){
         $em = $this->getDoctrine()->getManager();
    $query = $em->createQuery(
    'SELECT p.id
    FROM HotelBundle:Tasca p
    WHERE p.estatId = 1 and p.tipusTasca NOT IN
    (SELECT r
     FROM HotelBundle:TipusTasca r
     where r.id not in 
     (select d
      from Hotelbundle:TipusTreballador d
      where d.id = :tipusTreballador
         )
    )'
    )->setParameter('tipusTreballador', $tipusTreballador->getId());

    $array= array();
    foreach ($query as $key => $value) {
        array_push($array, $value);
    }
    return $array;
    }
}