<?php

namespace HotelBundle\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use HotelBundle\Entity\TipusTreballador;
use HotelBundle\Entity\Rol;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class TipusTreballadorController extends Controller
{
    public function indexAction(){
        $tipusTreb = $this->getDoctrine()->getRepository('HotelBundle:TipusTreballador')->findAll();
        return $this->render('HotelBundleAdminBundle:TipusTreballador:llista.html.twig', array(
                    'array' => $tipusTreb
        ));
    }

    public function addTipusTreballadorAction(Request $request)
    {
        $tipusTreballador = new TipusTreballador();
        $rol = new Rol();
 
        $form = $this->createFormBuilder()
            ->add('descripcio', TextType::class, array('label' => 'Descripció','attr' => array(
                    'class' => 'form-control'),
                    'label_attr'=> array('class' => 'label_text spaceTop')))
            ->add('rol', TextType::class, array('label' => 'Rol','attr' => array(
                    'class' => 'form-control'),
                    'label_attr'=> array('class' => 'label_text spaceTop')))
            ->add('save', SubmitType::class, array('label' => 'Crear Tipus Treballador' ,'attr' => array(
                        'class' => 'btn btn-primary spaceTop')))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $rol->setDescripcio($form->get('rol')->getData());           
            $tipusTreballador->setDescripcio($form->get('descripcio')->getData());
            $tipusTreballador->setRolAsociat($rol);

            $em = $this->getDoctrine()->getManager();
            $em->persist($rol);
            $em->persist($tipusTreballador);
            $em->flush();

            return $this->render('HotelBundleAdminBundle:Default:objectAdded.html.twig', array(
            'titol' => 'Nou Tipus de treball afegit'));
        };
 
        return $this->render('HotelBundleAdminBundle:Default:addObject.html.twig', array(
            'titol' => 'Afegir tipus de Treball',
            'form' => $form->createView()
        ));
    }

    public function editTipusTreballadorAction(Request $request)
    {
        $tipusTreballador = new TipusTreballador();
        $rol = new Rol();
 
        $form = $this->createFormBuilder()
            ->add('descripcio', TextType::class, array('label' => 'Descripció','attr' => array(
                    'class' => 'form-control'),
                    'label_attr'=> array('class' => 'label_text spaceTop')))
            ->add('rol', TextType::class, array('label' => 'Rol','attr' => array(
                    'class' => 'form-control'),
                    'label_attr'=> array('class' => 'label_text spaceTop')))
            ->add('save', SubmitType::class, array('label' => 'Crear Tipus Treballador' ,'attr' => array(
                        'class' => 'btn btn-primary spaceTop')))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $rol->setDescripcio($form->get('rol')->getData());           
            $tipusTreballador->setDescripcio($form->get('descripcio')->getData());
            $tipusTreballador->setRolAsociat($rol);

            $em = $this->getDoctrine()->getManager();
            $em->persist($rol);
            $em->persist($tipusTreballador);
            $em->flush();

            return $this->render('HotelBundleAdminBundle:Default:objectAdded.html.twig', array(
            'titol' => 'Nou Tipus de treball afegit'));
        };
 
        return $this->render('HotelBundleAdminBundle:Default:addObject.html.twig', array(
            'titol' => 'Afegir tipus de Treball',
            'form' => $form->createView()
        ));
    }

    public function deleteTipusTreballadorAction(Request $request)
    {
        $tipusTreballador = new TipusTreballador();
        $rol = new Rol();
 
        $form = $this->createFormBuilder()
            ->add('descripcio', TextType::class, array('label' => 'Descripció','attr' => array(
                    'class' => 'form-control'),
                    'label_attr'=> array('class' => 'label_text spaceTop')))
            ->add('rol', TextType::class, array('label' => 'Rol','attr' => array(
                    'class' => 'form-control'),
                    'label_attr'=> array('class' => 'label_text spaceTop')))
            ->add('save', SubmitType::class, array('label' => 'Crear Tipus Treballador' ,'attr' => array(
                        'class' => 'btn btn-primary spaceTop')))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $rol->setDescripcio($form->get('rol')->getData());           
            $tipusTreballador->setDescripcio($form->get('descripcio')->getData());
            $tipusTreballador->setRolAsociat($rol);

            $em = $this->getDoctrine()->getManager();
            $em->persist($rol);
            $em->persist($tipusTreballador);
            $em->flush();

            return $this->render('HotelBundleAdminBundle:Default:objectAdded.html.twig', array(
            'titol' => 'Nou Tipus de treball afegit'));
        };
 
        return $this->render('HotelBundleAdminBundle:Default:addObject.html.twig', array(
            'titol' => 'Afegir tipus de Treball',
            'form' => $form->createView()
        ));
    }

}