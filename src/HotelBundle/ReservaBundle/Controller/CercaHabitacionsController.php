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

  /*public function retornaHabitacionsAction(Request $request){

    $em = $this->getDoctrine()->getManager(); // ...or getEntityManager() prior to Symfony 2.1
    $connection = $em->getConnection();
    $statement = $connection->prepare("SELECT something FROM somethingelse WHERE id = :id");
    $statement->bindValue('id', 123);
    $statement->execute();
    $results = $statement->fetchAll();

  }*/

  /**
     * @Route("/ajax/posts", name="ajax_posts")
     * @Method({"GET"})
     */
  public function postsAction(Request $request)
  {
    if($request->isXmlHttpRequest())
    {
      $encoders = array(new JsonEncoder());
      $normalizers = array(new ObjectNormalizer());

      $serializer = new Serializer($normalizers, $encoders);

      $em = $this->getDoctrine()->getManager();
      $habitacions =  retornaHabitacions($request->get('dataInici'), $request->get('dataFi'));
      $response = new JsonResponse();
      $response->setStatusCode(200);
      $response->setData(array(
        'response' => 'success',
        'habitacions' => $serializer->serialize($habitacions, 'json')
        ));
      return $response;
    }
  }

  public function retornaHabitacions($dataInici, $dataFi){
    $connection = $em->getConnection();
    $statement = $connection->prepare("SELECT * FROM habitacions --WHERE id = :id");
    //$statement->bindValue('id', 123);
    $statement->execute();
    $results = $statement->fetchAll();
  }

}
