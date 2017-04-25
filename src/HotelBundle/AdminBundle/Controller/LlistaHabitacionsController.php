<?php

namespace HotelBundle\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\HttpFoundation\Request;

class LlistaHabitacionsController extends Controller
{
    public function indexAction(){
    	$habitacio = $this->getDoctrine()->getRepository('HotelBundle:Habitacio')->findAll();
        return $this->render('HotelBundleAdminBundle:Default:llista.html.twig', array(
                    'array' => $habitacio
        ));
    }

    public function deleteAction($id){
    	$habitacio = $this->getDoctrine()->getRepository('HotelBundle:Habitacio')->findOneById($id);
    	
    	if ($habitacio != null) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($habitacio);
            $em->flush();
            $this->get('session')->getFlashBag()->add(
                    'notice',array(
                    'type' => 'success',
                    'msg' => 'S\'ha eliminat l\'habitació'
            ));
        }else{
            $this->get('session')->getFlashBag()->add(
                    'notice',array(
                    'type' => 'danger',
                    'msg' => 'No s\'ha eliminat l\'habitació'
            ));
        }
        $arrayHabitacions = $this->getDoctrine()->getRepository('HotelBundle:Habitacio')->findAll();
        return $this->render('HotelBundleAdminBundle:Default:llista.html.twig', array(
                    'array' => $arrayHabitacions
        ));
    }
}
