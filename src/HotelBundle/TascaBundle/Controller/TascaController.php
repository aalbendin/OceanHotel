<?php

namespace HotelBundle\TascaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use HotelBundle\Entity\TipusTasca;
use HotelBundle\Entity\Treballador;
use HotelBundle\Entity\Treball;
use HotelBundle\Entity\Estat;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\DateTime;

class TascaController extends Controller
{

  public function indexAction(){
    $em = $this->getDoctrine()->getManager();
    $treb = $em->getRepository('HotelBundle:Treballador');
    $treballador = $treb->retornaTreballador($this->container);
    
    if($treballador != null){
    $tascaRepository = $em->getRepository('HotelBundle:Tasca');
    $treballs = $tascaRepository->getTasquesByTreballadorType($treballador);

    return $this->render('HotelBundleTascaBundle:Default:llistaTreballadorsTasca.html.twig', array(
      'array' => $treballs
      ));
    }else{
      $treballs= array();
      $this->get('session')->getFlashBag()->add(
          'notice',array(
          'type' => 'danger',
          'msg' => 'No s\'han trobat les teves dades de Treballador. Posat amb contacte amb algun administrador.'
      ));
      return $this->render('HotelBundleTascaBundle:Default:llistaTreballadorsTasca.html.twig', array(
      'array' => $treballs
      ));
    }
  }



  public function assignarTascaAction($idTasca){
    $em = $this->getDoctrine()->getManager();

    $usuari =  $this->container->get('security.token_storage')->getToken()->getUser();
    $usuariId = $usuari->getId();
    $treball = $this->getDoctrine()->getRepository('HotelBundle:Treball')->findOneByTasca($idTasca);
    $treballador = $this->getDoctrine()->getRepository('HotelBundle:Treballador')->findOneByUsuari($usuariId);
    
    $estatArray = $this->getDoctrine()->getRepository('HotelBundle:Estat')->findAll();
     $estatExis = false;
   
     foreach ($estatArray as $value) {
      if ($value->getId() == 2) {
        $estatExis = true ;
        break;
      }
    }
    if ($estatExis != true){
      $estat = new Estat();
      $estatTasca = $estat->setDescripcio('En Proces');
      $em->persist($estatTasca);
      $em->flush();
    }else{
      $estatTasca = $this->getDoctrine()->getRepository('HotelBundle:Estat')->findOneById(2);
    }

  $dataInici =  new \DateTime('now');
  $treball->setDataInici($dataInici);
  $treball->setTreballador($treballador);
  $treball->setEstat($estatTasca);

  $em->persist($treball);
  $em->flush();

  $this->get('session')->getFlashBag()->add(
    'notice',array(
      'type' => 'success',
      'msg' => 'S\'ha afegit aquesta tasca a la teva llista'
      ));
  return $this->redirect($this->generateurl('hotel_bundle_treballadors_tasca_homepage'));
}

  public function tasquesTreballadorAction(){

  $em = $this->getDoctrine()->getManager();
  $treb = $em->getRepository('HotelBundle:Treballador');
  $treballador = $treb->retornaTreballador($this->container);

  if($treballador != null){
      $idTreballador = $treballador->getId();
      $treball = $this->getDoctrine()->getRepository('HotelBundle:Treball')->findByTreballador($idTreballador);
      $tascaArray = array();
      foreach ($treball as  $value) {
        $idTasca = $value->getTasca();
        $tasca =  $this->getDoctrine()->getRepository('HotelBundle:Tasca')->findOneById($idTasca);
        array_push($tascaArray, $tasca);
      }

    return $this->render('HotelBundleTascaBundle:Default:llistaTascaTreballador.html.twig', array(
      'arrayTasca' => $tascaArray,
      'arrayTreball' => $treball
      ));
  }else{
    $tascaArray = array();
    $treball = array();
        $this->get('session')->getFlashBag()->add(
          'notice',array(
          'type' => 'danger',
          'msg' => 'No s\'han trobat les teves dades de Treballador. Posat amb contacte amb algun administrador.'
      ));
       return $this->render('HotelBundleTascaBundle:Default:llistaTascaTreballador.html.twig', array(
      'arrayTasca' => $tascaArray,
      'arrayTreball' => $treball
      ));
    }
  }

  public function finalitzarTascaAction($idTasca){
     $em = $this->getDoctrine()->getManager();

    $treball = $this->getDoctrine()->getRepository('HotelBundle:Treball')->findOneByTasca($idTasca);
    
    $estatArray = $this->getDoctrine()->getRepository('HotelBundle:Estat')->findAll();
    $estatExis = false;
   
     foreach ($estatArray as $value) {
      if ($value->getId() == 3) {
        $estatExis = true ;
        break;
      }
    }
    if ($estatExis != true){
      $estat = new Estat();
      $estatTasca = $estat->setDescripcio('Finalitzada');
      $em->persist($estatTasca);
      $em->flush();
    }else{
      $estatTasca = $this->getDoctrine()->getRepository('HotelBundle:Estat')->findOneById(3);
    }
     $dataFi =  new \DateTime('now');
     $treball->setDataFi($dataFi);
    $treball->setEstat($estatTasca);

    $em->persist($treball);

    $em->flush();

  $this->get('session')->getFlashBag()->add(
    'notice',array(
      'type' => 'success',
      'msg' => 'S\'ha marcat la tasca com a finalitzada'
      ));
  return $this->redirect($this->generateurl('hotel_bundle_treballador_tasca_llista'));
  }
}