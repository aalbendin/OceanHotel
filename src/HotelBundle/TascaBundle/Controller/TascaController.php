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
    $container= $this->container;
    $em = $this->getDoctrine()->getManager();
    $treb = $em->getRepository('HotelBundle:Treballador');
    $treballador = $treb->retornaTreballador($container);
    /*$tasques = $this->getTasques($treballador);*/
    //YYYYYYYYYYYYYYYYYYYYYYYYYYY
    //no funciona la query para hacer el filtro
    //he puesto esto para que se vea la pagina y provar lo del boton de assignar
    $tasques = $this->getDoctrine()->getRepository('HotelBundle:Tasca')->findAll();
    $treball = $this->getDoctrine()->getRepository('HotelBundle:Treball')->findAll();
    //var_dump($estat[0]->getId()); exit();
    return $this->render('HotelBundleTascaBundle:Default:llistaTreballadorsTasca.html.twig', array(
      'array' => $tasques,
      'arrayTreball' => $treball
      ));
  }

  public function getTasques($treballador){
    $em = $this->getDoctrine()->getManager();
    $tipusTreballador = $treballador->getTipusTreballador();
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

  public function assignarTascaAction($idTasca){
    $em = $this->getDoctrine()->getManager();

    $usuari =  $this->container->get('security.token_storage')->getToken()->getUser();
    $usuariId = $usuari->getId();
    $treball = $this->getDoctrine()->getRepository('HotelBundle:Treball')->findOneByTasca($idTasca);
    $treballador = $this->getDoctrine()->getRepository('HotelBundle:Treballador')->findOneByUsuari($usuariId);
    
    $estatArray = $this->getDoctrine()->getRepository('HotelBundle:Estat')->findAll();
     $estatExis = false;
   
     foreach ($estatArray as $value) {
      if ($value->getDescripcio() == 'proces') {
        $estatExis = true ;
        break;
      }
    }
    if ($estatExis != true){
      $estat = new Estat();
      $estatTasca = $estat->setDescripcio('proces');
      $em->persist($estatTasca);
      $em->flush();
    }else{
      $estatTasca = $this->getDoctrine()->getRepository('HotelBundle:Estat')->findOneByDescripcio('proces');
    }

  //  var_dump($estatTasca); exit();
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

  $usuari =  $this->container->get('security.token_storage')->getToken()->getUser();
  $usuariId = $usuari->getId();
  $treballador = $this->getDoctrine()->getRepository('HotelBundle:Treballador')->findOneByUsuari($usuariId);
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
  }

  public function finalitzarTascaAction($idTasca){
     $em = $this->getDoctrine()->getManager();

    $treball = $this->getDoctrine()->getRepository('HotelBundle:Treball')->findOneByTasca($idTasca);
    
    $estatArray = $this->getDoctrine()->getRepository('HotelBundle:Estat')->findAll();
    $estatExis = false;
   
     foreach ($estatArray as $value) {
      if ($value->getDescripcio() == 'finalitzada') {
        $estatExis = true ;
        break;
      }
    }
    if ($estatExis != true){
      $estat = new Estat();
      $estatTasca = $estat->setDescripcio('finalitzada');
      $em->persist($estatTasca);
      $em->flush();
    }else{
      $estatTasca = $this->getDoctrine()->getRepository('HotelBundle:Estat')->findOneByDescripcio('finalitzada');
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