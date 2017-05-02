<?php

namespace HotelBundle\ReservaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ComandaController extends Controller{

  //creacio de reservas





  //edicio de reservas XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX

public function buscarReservaAction($id,Request $request)
{
  $comanda = $this->getDoctrine()->getRepository('HotelBundle:Comanda')->findOneById($id);
  $client = $this->getDoctrine()->getRepository('HotelBundle:Client')->findOneById($comanda->getClient()->getId());
    $lineasComanda  = $this->buscarLineasReservaPerComanda($id);

    return $this->render('HotelBundleReservaBundle:Default:veureComanda.html.twig', array(
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
     $qb->expr()->gt('p.comanda', $idComanda)
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