<?php

namespace HotelBundle\ReservaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class LlistaHabitacionsController extends Controller
{
    public function indexAction(){
    	$habitacio = $this->getDoctrine()->getRepository('HotelBundle:Habitacio')->findAll();
    	$modalitat = $this->getDoctrine()->getRepository('HotelBundle:Modalitat')->findAll();
        return $this->render('HotelBundleReservaBundle:Default:llistaHabitacions.html.twig', array(
                    'array' => $habitacio,
                    'arrayModalitat' => $modalitat
        ));
    }

    
}
