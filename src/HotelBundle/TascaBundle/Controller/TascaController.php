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
      $trebRepo = $em->getRepository('HotelBundle:Treballador');
      $treballador = $trebRepo->retornaTreballador($container);

      $tascaRepository = $em->getRepository('HotelBundle:Tasca');
      $tasques = $tascaRepository->getTasquesByTreballadorType($treballador);

        return $this->render('HotelBundleTascaBundle:Default:llistaTreballadorsTasca.html.twig', array(
                    'array' => $tasques
        ));
    }

}