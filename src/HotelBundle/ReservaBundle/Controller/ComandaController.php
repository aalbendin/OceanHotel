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

public function retornaClient(){
  $usuari =  $this->container->get('security.token_storage')->getToken()->getUser();
    //echo "<script type='text/javascript'>alert('".$usuari."');</script>";
    $client = new Client();

    if($usuari == "anon."){
      $client->setNom(null);
    }else{
      $client = $this->getDoctrine()->getRepository('HotelBundle:Client')->findOneByUser($usuari->getId());
    }

    return $client;
}

  //creacio de reservas
public function afegirLiniaAction($id, Request $request){
  $habitacio = $this->getDoctrine()->getRepository('HotelBundle:Habitacio')->findOneById($id);

  $session = $request->getSession();

  //CCCCCCCCCCCCCCCCCCCCCCCCCCCCC 
  //TO-DO session comanda provisional.
  if(!$session->has('comanda')){
    $comanda = new Comanda();
    $comanda->setDataEntrada('2017-01-01');
    $comanda->setDataSortida('2017-01-15');
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
  if (!$session->has('client')){
    //client incomplet:
                $this->get('session')->getFlashBag()->add(
                    'notice',array(
                    'type' => 'info',
                    'msg' => 'Necesitamos tus datos de cliente!'
            ));
    return $this->redirect($this->generateurl('hotel_bundle_reserva_completarCliente'));

  //TO-DO un elseif que compruebe la comanda
    //}else if(!$session->has('comanda')){
    //dades comande incomplet:

  }else{
    //completar reserva
    $em = $this->getDoctrine()->getManager();
    //TO-DO peta el persist, posiblmenete se pueda hacer persist en cascada para guardar la comanda
    if($session->has('comanda')){
      $comanda = $session->get('comanda');
      $client = $this->retornaClient();
      $comanda->setClient($client);
      $arrayReserva= $session->get('arrayReserva');
      $comanda = $em->persist($comanda);
    foreach ($arrayReserva as $key => $reserva) {
      $reserva->setComanda($comanda);
      $em->persist($reserva);
    }


     
     $em->flush();

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
            $session->set('client', $client);

            $em = $this->getDoctrine()->getManager();
            $em->persist($client);
            $em->flush();

            $this->get('session')->getFlashBag()->add(
                    'notice',array(
                    'type' => 'success',
                    'msg' => 'S\'ha guardat l\'usuari'
            ));

            return $this->redirect($this->generateurl('hotel_bundle_reserva_homepage'));

        };
 
        return $this->render('HotelBundleReservaBundle:Default:addObject.html.twig', array(
            'titol' => 'Dades de Client',
            'form' => $form->createView()
        ));
  }


  //edicio de reservas XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX

public function buscarReservaAction($id,Request $request)
{
  $comanda = $this->getDoctrine()->getRepository('HotelBundle:Comanda')->findOneById($id);
  $client = $this->getDoctrine()->getRepository('HotelBundle:Client')->findOneById($comanda->getClient()->getId());
  $lineasComanda  = $this->buscarLineasReservaPerComanda($id);

    return $this->render('HotelBundleReservaBundle:Default:editarComanda.html.twig', array(
      'arrayLinea' => $lineasComanda , 'comanda' => $comanda, 'client' => $client
    ));
  }

  public function buscarLineasReservaPerComanda($idComanda)
  {
    $em = $this->getEntityManager();
    $qb = $em->createQueryBuilder();

    $q  = $qb->select(array('p'))
    ->from('HotelBundle:Reserva', 'p')
    ->where(
     $qb->expr()->get('p.comanda', $idComanda)
     )
    ->getQuery();


    return $q->getResult();
  }

public function editarLineaAction($id,Request $request)
{
}

public function editarClientAction($id, Request $request){

}

public function editarComandaAction($id,Request $request)
{
}


}