<?php

namespace HotelBundle\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use HotelBundle\Entity\TipusTreballador;
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

        $form = $this->createFormBuilder($tipusTreballador)
            ->add('descripcio', TextType::class, array('label' => 'Descripció','attr' => array(
                    'class' => 'form-control'),
                    'label_attr'=> array('class' => 'label_text spaceTop')))
            ->add('save', SubmitType::class, array('label' => 'Crear Tipus Treballador' ,'attr' => array(
                        'class' => 'btn btn-primary spaceTop')))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($tipusTreballador);
            $em->flush();

            $this->get('session')->getFlashBag()->add(
                    'notice',array(
                    'type' => 'success',
                    'msg' => 'S\'ha afegit el Tipus de Treballador'
            ));

            $array = $this->getDoctrine()->getRepository('HotelBundle:TipusTreballador')->findAll();
            return $this->render('HotelBundleAdminBundle:TipusTreballador:llista.html.twig', array(
                'array' => $array
                ));

        };

        return $this->render('HotelBundleAdminBundle:Default:addObject.html.twig', array(
            'titol' => 'Afegir tipus de Treball',
            'form' => $form->createView()
        ));

    }

    public function editTipusTreballadorAction(Request $request , $id)
    {
        $tipusTreb = $this->getDoctrine()->getRepository('HotelBundle:TipusTreballador')->findOneById($id);

        $form = $this->createFormBuilder($tipusTreb)
            ->add('descripcio', TextType::class, array('label' => 'Descripció','attr' => array(
                    'class' => 'form-control'),
                    'label_attr'=> array('class' => 'label_text spaceTop'),'data' => $tipusTreb->getDescripcio()))
            ->add('save', SubmitType::class, array('label' => 'Modificar Tipus Treballador' ,'attr' => array(
                        'class' => 'btn btn-primary spaceTop')))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();

                $this->get('session')->getFlashBag()->add(
                    'notice',array(
                    'type' => 'success',
                    'msg' => 'S\'ha modificat el Tipus de Treballador'
            ));

            $array = $this->getDoctrine()->getRepository('HotelBundle:TipusTreballador')->findAll();
            return $this->render('HotelBundleAdminBundle:TipusTreballador:llista.html.twig', array(
                'array' => $array
                ));
        };

        return $this->render('HotelBundleAdminBundle:Default:addObject.html.twig', array(
            'titol' => 'Modificar tipus de Treball',
            'form' => $form->createView()
        ));
    }

    public function deleteTipusTreballadorAction(Request $request , $id)
    {
        $tipusTreb = $this->getDoctrine()->getRepository('HotelBundle:TipusTreballador')->findOneById($id);

        if ($tipusTreb) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($tipusTreb);
            $em->flush();

         $this->get('session')->getFlashBag()->add(
                    'notice',array(
                    'type' => 'success',
                    'msg' => 'S\'ha eliminat el Tipus de Treballador'
            ));

        $array = $this->getDoctrine()->getRepository('HotelBundle:TipusTreballador')->findAll();
            return $this->render('HotelBundleAdminBundle:TipusTreballador:llista.html.twig', array(
                'array' => $array
                ));
        }
    }
}