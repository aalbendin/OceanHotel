<?php

namespace HotelBundle\ReservaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use HotelBundle\Entity\Reserva;
use HotelBundle\Entity\Comanda;
use HotelBundle\Entity\Client;
use HotelBundle\Entity\User;
use HotelBundle\Entity\Habitacio;
use HotelBundle\Entity\Modalitat;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\JsonResponse; 
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

class CercaHabitacionsController extends Controller{

  /*public function retornaHabitacionsAction(Request $request){

    $em = $this->getDoctrine()->getManager(); // ...or getEntityManager() prior to Symfony 2.1
    $connection = $em->getConnection();
    $statement = $connection->prepare("SELECT something FROM somethingelse WHERE id = :id");
    $statement->bindValue('id', 123);
    $statement->execute();
    $results = $statement->fetchAll();

  }*/

  /**
     * @Method({"GET"})
     */
  public function habitacionsAction(Request $request)
  {
    if($request->isXmlHttpRequest())
    {

      $encoders = array(new JsonEncoder());
      $normalizers = array(new ObjectNormalizer());

      $serializer = new Serializer($normalizers, $encoders);

      $em = $this->getDoctrine()->getManager();
      $habitacions =  $this->getHabitacions($request, $request->get('dataInici'), $request->get('dataFi'), $request->get('str'));
      //$habitacions = 1;
      /*$arrayHabitacions = array();
      foreach ($habitacions as $value) {
          array_push($arrayHabitacions, $this->getDoctrine()->getRepository('HotelBundle:Habitacio')->findOneById($value));
      }*/
      //$arrayHabitacions = 1;*/
      $modalitats = $this->getDoctrine()->getRepository('HotelBundle:Modalitat')->findAll();


      $response = new JsonResponse();
      $response->setStatusCode(200);
      $response->setData(array(
        'response' => 'success',
        'modalitat' => $serializer->serialize($modalitats, 'json'),
        'habitacions' => $serializer->serialize($habitacions, 'json')
        ));
      return $response;
    }

  }

  public function retornaHabitacions($dataInici, $dataFi, $str){
    $connection = $em->getConnection();
    $statement = $connection->prepare("SELECT * FROM habitacio --WHERE id = :id");
    //$statement->bindValue('id', 123);
    $statement->execute();
    $results = $statement->fetchAll();

    return $results;
  }

  public function getHabitacions(Request $request, $dataInici, $dataFi, $str){
    $em = $this->getDoctrine()->getManager();
    
    if($str > 0 && $dataInici > 0 && $dataFi > 0){

      $query = $em->createQuery(
      'SELECT p.id
       FROM HotelBundle:Habitacio p
      WHERE p.id NOT IN
      (SELECT r.habitacio
        FROM HotelBundle:Reserva r
        INNER JOIN HotelBundle:Comanda c on r.comanda = c.id
        where c.dataInici >= :dataInici and c.dataFi <= :dataFi)'
    )->setParameter('dataInici', $dataInici)->setParameter('dataFi', $dataFi);

    }else if ($str > 0){
      $query = $em->createQuery(
            'SELECT p
            FROM HotelBundle:Habitacio p where p.places = :str'
          )->setParameter('str', $str);
    }
    else {
      $query = $em->createQuery(
            'SELECT p
            FROM HotelBundle:Habitacio p '
          );
    }
    

  $habitacions = $query->getResult();

  return $habitacions;

  //return $query;
  }

/*
WHERE p.id NOT IN
    (SELECT r.habitacio
     FROM HotelBundle:Reserva r
     where r.dataInici >= :dataInici and r.dataFi <= :dataFi)
*/
/*

     * @Route("/ajax/posts", name="ajax_posts")

*/

/*

$query = $em->createQuery(
    'SELECT p.id
    FROM HotelBundle:Habitacio p
    WHERE p.id NOT IN
    (SELECT r.habitacioId
     FROM HotelBundle:Reserva r
     where r.dataInici >= :dataInici and r.dataFi <= :dataFi)
    ORDER BY p.price ASC'
    );->setParameter('dataInici', $dataInici)->setParameter('dataFi', $dataFi);

*/

}
