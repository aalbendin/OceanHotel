<?php

namespace HotelBundle\ReservaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use HotelBundle\Entity\Comanda;

class LlistaHabitacionsController extends Controller
{
    public function indexAction(Request $request){
    	$session = $request->getSession();
    	if($session->has('comanda')){
    		$comanda = $session->get('comanda');
    	}else{
    		$comanda = null;
    	}

    	$habitacio = $this->getDoctrine()->getRepository('HotelBundle:Habitacio')->findAll();
    	$modalitat = $this->getDoctrine()->getRepository('HotelBundle:Modalitat')->findAll();
        return $this->render('HotelBundleReservaBundle:Default:llistaHabitacions.html.twig', array(
                    'array' => $habitacio,
                    'arrayModalitat' => $modalitat,
                    'comanda' => $comanda
        ));
    }

    
}
