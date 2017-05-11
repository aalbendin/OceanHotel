<?php

namespace HotelBundle\TascaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use HotelBundle\Entity\Tasca;
use HotelBundle\Entity\TipusTasca;
use HotelBundle\Entity\TipusTreballador;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class AdministrarTascaController extends Controller
{
    public function indexAction()
    {
        $tasca = $this->getDoctrine()->getRepository('HotelBundle:Tasca')->findAll();

        return $this->render('HotelBundleTascaBundle:Default:llistaTasca.html.twig', array(
                    'array' => $tasca
        ));
    }

    public function addTascaAction(Request $request){
        $Tasca = new Tasca();
 
        $form = $this->createFormBuilder($Tasca)
            ->add('descripcio', TextType::class, array('label' => 'Descripció','attr' => array(
                    'class' => 'form-control'),
                    'label_attr'=> array('class' => 'label_text spaceTop')))   
            ->add('dataAlta',  DateType::class, array(
                'label' => 'Data d\'alta',
                'widget' => 'single_text',
           		 'html5' => false,
           		 'format' => 'dd/mm/yyyy',
          		  'attr' => ['class' => 'js-datepicker'])) 
            ->add('tipusTasca',  EntityType::class, array(
                'class' => 'HotelBundle:TipusTasca',
                'choice_label' => 'descripcio',
                'multiple' => FALSE,
                'label_attr'=> array('class' => 'label_text spaceTop'), 
                'attr' => array('class' => 'form-control')))            
            ->add('save', SubmitType::class, array('label' => 'Crear Tasca',
                    'attr' => array(
                        'class' => 'btn btn-warning mt')))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($Tasca);
            $em->flush();

            $this->get('session')->getFlashBag()->add(
                    'notice',array(
                    'type' => 'success',
                    'msg' => 'S\'ha afegit la tasca'
            ));            
            return $this->redirect($this->generateurl('hotel_bundle_admintasca_homepage'));
        };
 
        return $this->render('HotelBundleAdminBundle:Default:addObject.html.twig', array(
            'titol' => 'Afegir Tasca',
            'form' => $form->createView()
        ));
    }

    public function editTascaAction($id,Request $request){
        $Tasca = $this->getDoctrine()->getRepository('HotelBundle:Tasca')->findOneById($id);
 
        $form = $this->createFormBuilder($Tasca)
            ->add('descripcio', TextType::class, array('label' => 'Descripció','attr' => array(
                    'class' => 'form-control'),
                    'label_attr'=> array('class' => 'label_text spaceTop')))   
            ->add('dataAlta',  DateType::class, array(
                'label' => 'Data d\'alta',
                'widget' => 'single_text',
           		 'html5' => false,
           		 'format' => 'dd/mm/yyyy',
          		  'attr' => ['class' => 'js-datepicker'])) 
            ->add('tipusTasca',  EntityType::class, array(
                'class' => 'HotelBundle:TipusTasca',
                'choice_label' => 'descripcio',
                'multiple' => FALSE,
                'label_attr'=> array('class' => 'label_text spaceTop'), 
                'attr' => array('class' => 'form-control')))              
            ->add('save', SubmitType::class, array('label' => 'Editar Tasca',
                    'attr' => array(
                        'class' => 'btn btn-warning mt')))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($Tasca);
            $em->flush();

            $this->get('session')->getFlashBag()->add(
                    'notice',array(
                    'type' => 'success',
                    'msg' => 'S\'ha edita la tasca'
            ));            
            return $this->redirect($this->generateurl('hotel_bundle_admintasca_homepage'));
        };
 
        return $this->render('HotelBundleAdminBundle:Default:addObject.html.twig', array(
            'titol' => 'Editar Tasca',
            'form' => $form->createView()
        ));
    }


    public function deleteTascaAction($id){
        $Tasca = $this->getDoctrine()->getRepository('HotelBundle:Tasca')->findOneById($id);

        if ($Tasca != null) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($Tasca);
            $em->flush();
            $this->get('session')->getFlashBag()->add(
                    'notice',array(
                    'type' => 'success',
                    'msg' => 'S\'ha eliminat la tasca'
            ));
        }else{
            $this->get('session')->getFlashBag()->add(
                    'notice',array(
                    'type' => 'danger',
                    'msg' => 'No s\'ha eliminat la tasca'
            ));
        }
        return $this->redirect($this->generateurl('hotel_bundle_admintasca_homepage'));
    }
}
