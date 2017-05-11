<?php

namespace HotelBundle\TascaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use HotelBundle\Entity\TipusTasca;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class TipusTascaController extends Controller
{
    public function indexAction(){
        $tipusTasca = $this->getDoctrine()->getRepository('HotelBundle:TipusTasca')->findAll();

        return $this->render('HotelBundleTascaBundle:Default:tipusTasca.html.twig', array(
                    'array' => $tipusTasca
        ));
    }

    public function addTipusTascaAction(Request $request)
    {
        $tipusTasca = new TipusTasca();
 
        $form = $this->createFormBuilder($tipusTasca)
            ->add('descripcio', TextType::class, array('label' => 'Descripció','attr' => array(
                    'class' => 'form-control'),
                    'label_attr'=> array('class' => 'label_text spaceTop')))   
            ->add('tipusTreballador',  EntityType::class, array(
                'class' => 'HotelBundle:TipusTreballador',
                'choice_label' => 'descripcio',
                'multiple' => FALSE,
                'label_attr'=> array('class' => 'label_text spaceTop'), 
                'attr' => array('class' => 'form-control')))    
            ->add('save', SubmitType::class, array('label' => 'Crear Tipus Tasca',
                    'attr' => array(
                        'class' => 'btn btn-warning mt')))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($tipusTasca);
            $em->flush();

            $this->get('session')->getFlashBag()->add(
                    'notice',array(
                    'type' => 'success',
                    'msg' => 'S\'ha afegit el Tipus de tasca'
            ));            
            return $this->redirect($this->generateurl('hotel_bundle_tasca_homepage'));
        };
 
        return $this->render('HotelBundleAdminBundle:Default:addObject.html.twig', array(
            'titol' => 'Afegir tipus tasca',
            'form' => $form->createView()
        ));
    }

    public function editTipusTascaAction($id,Request $request)
    {
        $TipusTasca = $this->getDoctrine()->getRepository('HotelBundle:TipusTasca')->findOneById($id);
 
        $form = $this->createFormBuilder($tipusTasca)
            ->add('descripcio', TextType::class, array('label' => 'Descripció','attr' => array(
                    'class' => 'form-control'),
                    'label_attr'=> array('class' => 'label_text spaceTop')))   
            ->add('tipusTreballador',  EntityType::class, array(
                'class' => 'HotelBundle:TipusTreballador',
                'choice_label' => 'descripcio',
                'multiple' => FALSE,
                'label_attr'=> array('class' => 'label_text spaceTop'), 
                'attr' => array('class' => 'form-control')))    
            ->add('save', SubmitType::class, array('label' => 'Editar Tipus tasca',
                    'attr' => array(
                        'class' => 'btn btn-warning mt')))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($TipusTasca);
            $em->flush();

            $this->get('session')->getFlashBag()->add(
                    'notice',array(
                    'type' => 'success',
                    'msg' => 'S\'ha editat el Tipus de tasca'
            ));
            return $this->redirect($this->generateurl('hotel_bundle_tasca_homepage'));
        };
 
        return $this->render('HotelBundleAdminBundle:Default:addObject.html.twig', array(
            'titol' => 'Editar tipus d\'Habitació',
            'form' => $form->createView()
        ));
    }

    public function deleteTipusTascaAction($id){
        $tipusTasca = $this->getDoctrine()->getRepository('HotelBundle:TipusTasca')->findOneById($id);

        if ($tipusTasca != null) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($tipusTasca);
            $em->flush();
            $this->get('session')->getFlashBag()->add(
                    'notice',array(
                    'type' => 'success',
                    'msg' => 'S\'ha eliminat el tipus de tasca'
            ));
        }else{
            $this->get('session')->getFlashBag()->add(
                    'notice',array(
                    'type' => 'danger',
                    'msg' => 'No s\'ha eliminat el tipus de tasca'
            ));
        }
        return $this->redirect($this->generateurl('hotel_bundle_tasca_homepage'));
    }

}