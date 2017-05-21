<?php

namespace HotelBundle\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use HotelBundle\Entity\Habitacio;
use HotelBundle\Entity\TipusHabitacio;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class HabitacioController extends Controller
{
    public function indexAction()
    {
        return $this->render('HotelBundle:Default:backend.html.twig');
    }

    public function addHabitacioAction(Request $request)
    {
        $habitacio = new Habitacio();
        
 
        $form = $this->createFormBuilder()
            ->add('numHabitacio', TextType::class, array('label' => 'Num. Habitació','attr' => array(
                    'class' => 'form-control'),
                    'label_attr'=> array('class' => 'label_text spaceTop')))
            ->add('places', TextType::class, array('label' => 'Num. Places','attr' => array(
                    'class' => 'form-control'),
                    'label_attr'=> array('class' => 'label_text spaceTop')))
            ->add('preu', NumberType::class, array('label' => 'Preu','attr' => array(
                    'class' => 'form-control'),
                    'label_attr'=> array('class' => 'label_text spaceTop')))
            ->add('tipusHabitacio', EntityType::class, array(
                'class' => 'HotelBundle:TipusHabitacio',
                'choice_label' => 'descripcio',
                'multiple' => FALSE,
                'label_attr'=> array('class' => 'label_text spaceTop'), 
                'attr' => array('class' => 'form-control')))
            ->add('save', SubmitType::class, array('label' => 'Crear Habitacio' ,'attr' => array(
                        'class' => 'btn btn-primary spaceTop')))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $habitacio->setNumHabitacio($form->get('numHabitacio')->getData());
            $habitacio->setPlaces($form->get('places')->getData());
            $habitacio->setPreu($form->get('preu')->getData());
            $habitacio->setTipusHabitacio($form->get('tipusHabitacio')->getData());
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($habitacio);
            $em->flush();

            /*return $this->render('HotelBundleAdminBundle:Default:objectAdded.html.twig', array(
            'titol' => 'Nova habitació afegida'));*/
            $this->get('session')->getFlashBag()->add(
                    'notice',array(
                    'type' => 'success',
                    'msg' => 'S\'ha afegit l\'habitació'
            ));

            return $this->redirect($this->generateurl('hotel_bundle_llistaHabitacions'));

        };
 
        return $this->render('HotelBundleAdminBundle:Default:addObject.html.twig', array(
            'titol' => 'Afegir habitació',
            'form' => $form->createView()
        ));
    }

    public function editHabitacioAction($id, Request $request)
    {
        $habitacio = $this->getDoctrine()->getRepository('HotelBundle:Habitacio')->findOneById($id);
        
 
        $form = $this->createFormBuilder($habitacio)
            ->add('numHabitacio', TextType::class, array('label' => 'Num. Habitació','attr' => array(
                    'class' => 'form-control'),
                    'label_attr'=> array('class' => 'label_text spaceTop')))
            ->add('places', TextType::class, array('label' => 'Num. Places','attr' => array(
                    'class' => 'form-control'),
                    'label_attr'=> array('class' => 'label_text spaceTop')))
            ->add('preu', NumberType::class, array('label' => 'Preu','attr' => array(
                    'class' => 'form-control'),
                    'label_attr'=> array('class' => 'label_text spaceTop')))
            ->add('tipusHabitacio', EntityType::class, array(
                'class' => 'HotelBundle:TipusHabitacio',
                'choice_label' => 'descripcio',
                'multiple' => FALSE,
                'label_attr'=> array('class' => 'label_text spaceTop'), 
                'attr' => array('class' => 'form-control')))
            ->add('save', SubmitType::class, array('label' => 'Guardar' ,'attr' => array(
                        'class' => 'btn btn-primary spaceTop')))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $habitacio->setNumHabitacio($form->get('numHabitacio')->getData());
            $habitacio->setPlaces($form->get('places')->getData());
            $habitacio->setPreu($form->get('preu')->getData());
            $habitacio->setTipusHabitacio($form->get('tipusHabitacio')->getData());
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($habitacio);
            $em->flush();

            /*return $this->render('HotelBundleAdminBundle:Default:objectAdded.html.twig', array(
            'titol' => 'Habitació guardada'));*/


            $this->get('session')->getFlashBag()->add(
                    'notice',array(
                    'type' => 'success',
                    'msg' => 'S\'ha modificat l\'habitació'
            ));
            return $this->redirect($this->generateurl('hotel_bundle_llistaHabitacions'));

        };
 
        return $this->render('HotelBundleAdminBundle:Default:addObject.html.twig', array(
            'titol' => 'Editar habitació',
            'form' => $form->createView()
        ));
    }

}