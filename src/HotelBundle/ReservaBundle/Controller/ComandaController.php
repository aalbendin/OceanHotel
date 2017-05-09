<?php

namespace HotelBundle\ReservaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use HotelBundle\Entity\Reserva;
use HotelBundle\Entity\Comanda;
use HotelBundle\Entity\Client;
use HotelBundle\Entity\User;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class ComandaController extends Controller{

  public function indexAction(Request $request){
    $session = $request->getSession();

    if($session->has('arrayReserva')){
      $lineasComanda =$session->get('arrayReserva');
    }else{
      $lineasComanda = array();
    }

    return $this->render('HotelBundleReservaBundle:Default:veureComanda.html.twig', array(
      'arrayLinea' => $lineasComanda,
      'client' => $this->retornaClient()
      ));

  }

  public function indexReservasAction(Request $request){
      $client = $this->retornaClient();
      $comandes = $this->getDoctrine()->getRepository('HotelBundle:Comanda')->findBy(array('client' => $client->getId()));

    return $this->render('HotelBundleReservaBundle:Default:veureComandes.html.twig', array(
      'arrayComanda' => $comandes
    ));

  }

  public function veureReservaAction($id,Request $request){
      $client = $this->retornaClient();
      $comanda = $this->getDoctrine()->getRepository('HotelBundle:Comanda')->findOneById($id);
      $reservas = $this->getDoctrine()->getRepository('HotelBundle:Reserva')->findBy(array('comanda' => $comanda->getId()));

    return $this->render('HotelBundleReservaBundle:Default:veureReserva.html.twig', array(
      'comanda' => $comanda,
      'arrayReserva' => $reservas,
      'client' => $client
    ));

  }

  public function retornaClient(){
    $usuari =  $this->container->get('security.token_storage')->getToken()->getUser();
    $client = new Client();

    if($usuari == "anon."){
      $client->setNom(null);
    }else{
      $client = $this->getDoctrine()->getRepository('HotelBundle:Client')->findOneByUser($usuari->getId());
    }

    return $client;
  }

  public function retornaUser(){
    return  $this->container->get('security.token_storage')->getToken()->getUser();
  }

  //creacio de reservas
  public function afegirLiniaAction($id, Request $request){
    $usuari =  $this->container->get('security.token_storage')->getToken()->getUser();
    if($usuari == "anon."){
      return $this->redirect($this->generateurl('fos_user_security_login'));
    }else{
      $habitacio = $this->getDoctrine()->getRepository('HotelBundle:Habitacio')->findOneById($id);

      $session = $request->getSession();

  //CCCCCCCCCCCCCCCCCCCCCCCCCCCCC 
  //TO-DO session comanda provisional.
      if(!$session->has('comanda')){
        $comanda = new Comanda();
        //$comanda->setDataEntrada('2017-01-01');
        //$comanda->setDataSortida('2017-01-15');
        $session->set('comanda',$comanda);
      }

      if($session->has('arrayReserva')){
        $arrayReserva = $session->get('arrayReserva');    
      }else{
        $arrayReserva = array();
      }

      $reserva = new Reserva();
      $reserva->setHabitacio($habitacio);
      array_push($arrayReserva,$reserva);

      $arrayReserva = $session->set('arrayReserva', $arrayReserva);

      $this->get('session')->getFlashBag()->add(
        'notice',array(
          'type' => 'success',
          'msg' => 'S\'ha afegit l\'habitació'
          ));

      return $this->redirect($this->generateurl('hotel_bundle_reserva_comanda')); 
    }
  }

  public function eliminarLiniaAction($id, Request $request){

    $session = $request->getSession();

    if($session->has('arrayReserva')){
      $arrayReserva = $session->get('arrayReserva');
      foreach ($arrayReserva as $key => $reserva) {
        if ($reserva->getHabitacio()->getId() == $id){
          unset($arrayReserva[$key]);
        }
      }

    }else{
      $arrayReserva = array();
    }

    $arrayReserva = $session->set('arrayReserva', $arrayReserva);

    $this->get('session')->getFlashBag()->add(
      'notice',array(
        'type' => 'success',
        'msg' => 'S\'ha eliminat l\'habitació'
        ));

    return $this->redirect($this->generateurl('hotel_bundle_reserva_comanda'));

  }

  public function completarReservaAction(Request $request){
    $session = $request->getSession();
    $cli = $this->retornaClient() ;
    if ( $cli == null ||$cli->getNom()== null){
      return $this->redirect($this->generateurl('hotel_bundle_reserva_completarCliente'));
    }else{
    //completar reserva
      $em = $this->getDoctrine()->getManager();

      if($session->has('comanda')){
        $comanda = $session->get('comanda');
        $client = $this->retornaClient();
        $comanda->setClient($client);
        $arrayReserva= $session->get('arrayReserva');
        $em->persist($comanda);
        foreach ($arrayReserva as $reserva) {
          $res = new Reserva();
          $habitacio = $this->getDoctrine()->getRepository('HotelBundle:Habitacio')->findOneById($reserva->getHabitacio()->getId());
          if (!is_null($reserva->getModalitat())){
            $modalitat = $this->getDoctrine()->getRepository('HotelBundle:Modalitat')->findOneById($reserva->getModalitat()->getId());
            $res->setModalitat($modalitat);
          }
          $res->setHabitacio($habitacio);
          $res->setComanda($comanda);
          $em->persist($res);
        }

        $em->flush();

        $session->remove('comanda');
        $session->remove('arrayReserva');


        $this->get('session')->getFlashBag()->add(
          'notice',array(
            'type' => 'success',
            'msg' => 'S\'ha completat la reserva!'
            ));
        return $this->redirect($this->generateurl('hotel_bundle_reserva_homepage'));
      }else{
    //TO-DO crear/buscar comanda
       return $this->redirect($this->generateurl('hotel_bundle_reserva_homepage'));
     }
   }


 }

 public function fichaClienteAction(Request $request){
  $client = $this->retornaClient();

  if ($client == null){
    $this->get('session')->getFlashBag()->add(
      'notice',array(
        'type' => 'info',
        'msg' => 'Necesitamos tus datos de cliente!'
        ));
    $client = new Client();
  }

  $form = $this->createFormBuilder($client)
  ->add('nom', TextType::class, array('label' => 'Nom','attr' => array(
    'class' => 'form-control'),
  'label_attr'=> array('class' => 'label_text spaceTop')))
  ->add('cognoms', TextType::class, array('label' => 'Cognoms','attr' => array(
    'class' => 'form-control'),
  'label_attr'=> array('class' => 'label_text spaceTop')))
  ->add('dataNaixament', DateType::class, array('label' => 'Data de Naixament',
    'widget' => 'single_text',
    'html5' => false,
    'format' => 'dd/MM/yyyy',
    'attr' => ['class' => 'js-datepicker form-control'],
    'label_attr'=> array('class' => 'label_text spaceTop')))
  ->add('nif', TextType::class, array('label' => 'NIF','attr' => array(
    'class' => 'form-control'),
  'label_attr'=> array('class' => 'label_text spaceTop')))
  ->add('save', SubmitType::class, array('label' => 'Guardar ficha de client' ,'attr' => array(
    'class' => 'btn btn-warning mt')))
  ->getForm();

  $form->handleRequest($request);

  if ($form->isSubmitted() && $form->isValid()) {
    $session = $request->getSession();

    $user = $this->retornaUser();

    if ($user != "anon." || $user != null){
      $client->setUser($user);
      $session->set('client',$client);

      $em = $this->getDoctrine()->getManager();
      $em->persist($client);
      $em->flush();
    }
    $this->get('session')->getFlashBag()->add(
      'notice',array(
        'type' => 'success',
        'msg' => 'S\'ha guardat l\'usuari'
        ));

    return $this->redirect($this->generateurl('hotel_bundle_reserva_acabarReserva'));

  };

  return $this->render('HotelBundleReservaBundle:Default:addObject.html.twig', array(
    'titol' => 'Dades de Client',
    'form' => $form->createView()
    ));
}


  //edicio de reservas XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX

public function buscarReservaAction(Request $request)
{
   
  $form = $this->createFormBuilder()
  ->add('codi', TextType::class, array('label' => 'Codi comanda','attr' => array(
    'class' => 'form-control'),
  'label_attr'=> array('class' => 'label_text spaceTop')))
  ->add('save', SubmitType::class, array('label' => 'Buscar reserva' ,'attr' => array(
    'class' => 'btn btn-warning mt')))
  ->getForm();

  $form->handleRequest($request);

  if ($form->isSubmitted() && $form->isValid()) {
    $session = $request->getSession();

    $codiComanda = $form->get('codi')->getData();
    return $this->redirectBuscarReserva($codiComanda);
  } 
  return $this->render('HotelBundleReservaBundle:Default:buscarComanda.html.twig', array(
    'titol' => 'Buscar comanda',
    'form' => $form->createView()
  ));

}

public function redirectBuscarReserva($codiComanda){

  $comanda = $this->getDoctrine()->getRepository('HotelBundle:Comanda')->findOneById($codiComanda);
  $client = $this->getDoctrine()->getRepository('HotelBundle:Client')->findOneById($comanda->getClient()->getId());
  $lineasComanda = $this->getDoctrine()->getRepository('HotelBundle:Reserva')->findBy(array('comanda' => $comanda->getId()));

  return $this->render('HotelBundleReservaBundle:Default:editarComanda.html.twig', array(
    'arrayLinea' => $lineasComanda , 'comanda' => $comanda, 'client' => $client
    ));
}

public function editarClientAction($idComanda, $id, Request $request){
    {
        $client = $this->getDoctrine()->getRepository('HotelBundle:Client')->findOneById($id);

         $form = $this->createFormBuilder($client)
            ->add('nom', TextType::class, array('label' => 'Nom','attr' => array(
                    'class' => 'form-control'),
                    'label_attr'=> array('class' => 'label_text spaceTop')))  
            ->add('cognoms', TextType::class, array('label' => 'Cognoms','attr' => array(
                    'class' => 'form-control'),
                    'label_attr'=> array('class' => 'label_text spaceTop'))) 
            ->add('dataNaixament', DateType::class, array('label' => 'Data Naixement',
            'widget' => 'single_text',
            'html5' => false,
            'format' => 'dd/mm/yyyy',
            'attr' => ['class' => 'js-datepicker'])) 
            ->add('nif', TextType::class, array('label' => 'NIF','attr' => array(
                    'class' => 'form-control'),
                    'label_attr'=> array('class' => 'label_text spaceTop')))  
            ->add('user', EntityType::class, array(
            'class' => 'HotelBundle:User',
            'label' => 'Usuari',
            'choice_label' => 'username',
            'multiple' => FALSE,
            'label_attr'=> array('class' => 'label_text spaceTop'), 
            'attr' => array('class' => 'form-control selectRol'))) 
            ->add('save', SubmitType::class, array('label' => 'Editar Client',
                    'attr' => array(
                        'class' => 'btn btn-warning mt')))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($client);
            $em->flush();

            $this->get('session')->getFlashBag()->add(
                    'notice',array(
                    'type' => 'success',
                    'msg' => 'S\'ha editat el Client Correctament'
            ));
            return $this->redirectBuscarReserva($idComanda);
        };
 
        return $this->render('HotelBundleAdminBundle:Default:addObject.html.twig', array(
            'titol' => 'Editar Client',
            'form' => $form->createView()
        ));
    }
}

public function donarBaixaComandaAction($id,Request $request){
  $comanda = $this->getDoctrine()->getRepository('HotelBundle:Comanda')->findOneById($id);
  $preuFinal = 0;
  $lineasComanda = $this->getDoctrine()->getRepository('HotelBundle:Reserva')->findBy(array('comanda' => $comanda->getId()));
  $em = $this->getDoctrine()->getManager();
  foreach ($lineasComanda as $reserva) {
    $preuFinal = $preuFinal + $reserva->getHabitacio()->getPreu();
    $em->remove($reserva);
  }
  $em->remove($comanda);
  $em->flush();
  
  $msg = "Reserva cancelada, es tornaran un total de: ".$preuFinal."€ al client";
      $this->get('session')->getFlashBag()->add(
      'notice',array(
        'type' => 'success',
        'msg' => $msg
        ));
  return $this->redirect($this->generateurl('hotel_bundle_admin_reserva_buscaComanda'));
}

  public function eliminarLineaAdminAction($idComanda,$id,Request $request)
  {
    $lineaComanda = $this->getDoctrine()->getRepository('HotelBundle:Reserva')->findOneById($id);

    $dinero= $lineaComanda->getHabitacio()->getPreu();

    $em = $this->getDoctrine()->getManager();
    $em->remove($lineaComanda);
    $em->flush();
    
    $msg = "Es tornaran un total de: ".$dinero."€ al client";
        $this->get('session')->getFlashBag()->add(
        'notice',array(
          'type' => 'success',
          'msg' => $msg
          ));

    return $this->redirectBuscarReserva($idComanda);
  }
}