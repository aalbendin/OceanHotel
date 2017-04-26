<?php

namespace HotelBundle\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use HotelBundle\Entity\TipusHabitacio;
use HotelBundle\Entity\Rol;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class TipusHabitacioController extends Controller
{
    public function mostrarTipusHabitacioAction(){
        $tipusHabitacio = $this->getDoctrine()->getRepository('HotelBundle:TipusHabitacio')->findAll();

        return $this->render('HotelBundleAdminBundle:Default:tipusHabitacio.html.twig', array(
                    'array' => $tipusHabitacio
        ));
    }

    public function addTipusHabitacioAction(Request $request)
    {
        $TipusHabitacio = new TipusHabitacio();
 
        $form = $this->createFormBuilder($TipusHabitacio)
            ->add('descripcio', TextType::class, array('label' => 'Descripció','attr' => array(
                    'class' => 'form-control'),
                    'label_attr'=> array('class' => 'label_text spaceTop')))   
            ->add('Imatge', TextType::class, array('label' => 'Imatge','attr' => array(
                    'class' => 'form-control'),
                    'label_attr'=> array('class' => 'label_text spaceTop')))           
            ->add('save', SubmitType::class, array('label' => 'Crear Tipus d\'Habitació',
                    'attr' => array(
                        'class' => 'btn btn-warning mt')))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($TipusHabitacio);
            $em->flush();

            $this->get('session')->getFlashBag()->add(
                    'notice',array(
                    'type' => 'success',
                    'msg' => 'S\'ha afegit el Tipus d\'Habitació'
            ));            
            return $this->redirect($this->generateurl('hotel_bundle_tipusHabitacio'));
        };
 
        return $this->render('HotelBundleAdminBundle:Default:addObject.html.twig', array(
            'titol' => 'Afegir tipus d\'Habitació',
            'form' => $form->createView()
        ));
    }

    public function editTipusHabitacioAction($id,Request $request)
    {
        $TipusHabitacio = $this->getDoctrine()->getRepository('HotelBundle:TipusHabitacio')->findOneById($id);
        $form = $this->createFormBuilder($TipusHabitacio)
            ->add('descripcio', TextType::class, array('label' => 'Descripció','attr' => array(
                    'class' => 'form-control'),
                    'label_attr'=> array('class' => 'label_text spaceTop')))  
            ->add('Imatge', TextType::class, array('label' => 'Imatge','attr' => array(
                    'class' => 'form-control'),
                    'label_attr'=> array('class' => 'label_text spaceTop')))       
            ->add('save', SubmitType::class, array('label' => 'Editar el Tipus d\'Habitació',
                    'attr' => array(
                        'class' => 'btn btn-warning mt')))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($TipusHabitacio);
            $em->flush();

            $this->get('session')->getFlashBag()->add(
                    'notice',array(
                    'type' => 'success',
                    'msg' => 'S\'ha editat el Tipus d\'Habitació'
            ));
            return $this->redirect($this->generateurl('hotel_bundle_tipusHabitacio'));
        };
 
        return $this->render('HotelBundleAdminBundle:Default:addObject.html.twig', array(
            'titol' => 'Editar tipus d\'Habitació',
            'form' => $form->createView()
        ));
    }

    public function deleteTipusHabitacioAction($id){
        $tipusHabitacio = $this->getDoctrine()->getRepository('HotelBundle:TipusHabitacio')->findOneById($id);

        if ($tipusHabitacio != null) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($tipusHabitacio);
            $em->flush();
            $this->get('session')->getFlashBag()->add(
                    'notice',array(
                    'type' => 'success',
                    'msg' => 'S\'ha eliminat el tipus d\'Habitació'
            ));
        }else{
            $this->get('session')->getFlashBag()->add(
                    'notice',array(
                    'type' => 'danger',
                    'msg' => 'No s\'ha eliminat el tipus d\'Habitació'
            ));
        }
        return $this->redirect($this->generateurl('hotel_bundle_tipusHabitacio'));
    }

}