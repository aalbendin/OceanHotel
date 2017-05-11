<?php

namespace HotelBundle\Repository;

/**
 * TreballadorRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class TreballadorRepository extends \Doctrine\ORM\EntityRepository
{
	public function retornaTreballador(){
     $usuari =  $this->get('security.token_storage')->getToken()->getUser();
    $treballador = new Treballador();

    if($usuari == "anon."){
      $treballador->setNom(null);
    }else{
      $treballador = $this->getDoctrine()->getRepository('HotelBundle:Treballador')->findOneByUser($usuari->getId());
    }

    return $treballador;
  }
}
