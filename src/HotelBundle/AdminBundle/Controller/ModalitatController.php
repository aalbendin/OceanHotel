<?php

namespace HotelBundle\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use HotelBundle\Entity\Modalitat;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class ModalitatController extends Controller

{

    public function indexAction(){
        $modalitats = $this->getDoctrine()->getRepository('HotelBundle:Modalitat')->findAll();
        return $this->render('HotelBundleAdminBundle:Modalitat:llista.html.twig', array(
                    'array' => $modalitats
        ));
    }

    public function addModalitatAction(Request $request)
    {
       $Modalitat = new Modalitat();

        $form = $this->createFormBuilder($Modalitat)
            ->add('descripcio', TextType::class, array('label' => 'Descripció','attr' => array(
                    'class' => 'form-control'),
                    'label_attr'=> array('class' => 'label_text spaceTop')))
            ->add('preu', NumberType::class, array('label' => 'Preu','attr' => array(
                    'class' => 'form-control'),
                    'label_attr'=> array('class' => 'label_text spaceTop')))
            ->add('save', SubmitType::class, array('label' => 'Crear Modalitat' ,'attr' => array(
                        'class' => 'btn btn-primary spaceTop')))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $descripcio = $form->get('descripcio')->getData();
            $preu = $form->get('preu')->getData();
            $Modalitat->setDescripcio($descripcio. ' (+'.$preu.' €)');
            $em = $this->getDoctrine()->getManager();
            $em->persist($Modalitat);
            $em->flush();

            $this->get('session')->getFlashBag()->add(
                    'notice',array(
                    'type' => 'success',
                    'msg' => 'S\'ha afegit la Modalitat'
            ));

            return $this->redirect($this->generateurl('hotel_bundle_modalitats'));
        };

        return $this->render('HotelBundleAdminBundle:Default:addObject.html.twig', array(
            'titol' => 'Afegir Modalitat',
            'form' => $form->createView()
        ));

    }

    public function editModalitatAction(Request $request , $id)
    {
        $modalitat = $this->getDoctrine()->getRepository('HotelBundle:Modalitat')->findOneById($id);

        $form = $this->createFormBuilder($modalitat)
            ->add('descripcio', TextType::class, array('label' => 'Descripció','attr' => array(
                    'class' => 'form-control'),
                    'label_attr'=> array('class' => 'label_text spaceTop')))
            ->add('preu', NumberType::class, array('label' => 'Preu','attr' => array(
                    'class' => 'form-control'),
                    'label_attr'=> array('class' => 'label_text spaceTop')))
            ->add('save', SubmitType::class, array('label' => 'Crear Modalitat' ,'attr' => array(
                        'class' => 'btn btn-primary spaceTop')))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();

                $this->get('session')->getFlashBag()->add(
                    'notice',array(
                    'type' => 'success',
                    'msg' => 'S\'ha modificat la Modalitat'
            ));

            
            return $this->redirect($this->generateurl('hotel_bundle_modalitats'));
        };

        return $this->render('HotelBundleAdminBundle:Default:addObject.html.twig', array(
            'titol' => 'Modificar Modalitat',
            'form' => $form->createView()
        ));
    }

    public function deleteModalitatAction(Request $request , $id)
    {
        $modalitat = $this->getDoctrine()->getRepository('HotelBundle:Modalitat')->findOneById($id);

        if ($modalitat) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($modalitat);
            $em->flush();

         $this->get('session')->getFlashBag()->add(
                    'notice',array(
                    'type' => 'success',
                    'msg' => 'S\'ha eliminat la Modalitat'
            ));

        return $this->redirect($this->generateurl('hotel_bundle_modalitats'));
        }
    }
}