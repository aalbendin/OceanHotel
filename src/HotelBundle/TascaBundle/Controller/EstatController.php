<?php

namespace HotelBundle\TascaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use HotelBundle\Entity\Estat;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class EstatController extends Controller
{
    public function indexAction(){
        $estats = $this->getDoctrine()->getRepository('HotelBundle:Estat')->findAll();

        return $this->render('HotelBundleTascaBundle:Default:estat.html.twig', array(
                    'array' => $estats
        ));
    }

    public function addEstatAction(Request $request)
    {
        $estat = new Estat();
 
        $form = $this->createFormBuilder($estat)
            ->add('descripcio', TextType::class, array('label' => 'Descripció','attr' => array(
                    'class' => 'form-control'),
                    'label_attr'=> array('class' => 'label_text spaceTop')))   
            ->add('save', SubmitType::class, array('label' => 'Crear Estat',
                    'attr' => array(
                        'class' => 'btn btn-warning mt')))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($estat);
            $em->flush();

            $this->get('session')->getFlashBag()->add(
                    'notice',array(
                    'type' => 'success',
                    'msg' => 'S\'ha afegit l\'Estat'
            ));            
            return $this->redirect($this->generateurl('hotel_bundle_estat_homepage'));
        };
 
        return $this->render('HotelBundleAdminBundle:Default:addObject.html.twig', array(
            'titol' => 'Afegir Estat',
            'form' => $form->createView()
        ));
    }

    public function editEstatAction($id,Request $request)
    {
        $estat = $this->getDoctrine()->getRepository('HotelBundle:Estat')->findOneById($id);
 
        $form = $this->createFormBuilder($estat)
            ->add('descripcio', TextType::class, array('label' => 'Descripció','attr' => array(
                    'class' => 'form-control'),
                    'label_attr'=> array('class' => 'label_text spaceTop'))) 
            ->add('save', SubmitType::class, array('label' => 'Editat Estat',
                    'attr' => array(
                        'class' => 'btn btn-warning mt')))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($estat);
            $em->flush();

            $this->get('session')->getFlashBag()->add(
                    'notice',array(
                    'type' => 'success',
                    'msg' => 'S\'ha editat l\'estat'
            ));
            return $this->redirect($this->generateurl('hotel_bundle_estat_homepage'));
        };
 
        return $this->render('HotelBundleAdminBundle:Default:addObject.html.twig', array(
            'titol' => 'Editar tipus d\'Habitació',
            'form' => $form->createView()
        ));
    }

    public function deleteEstatAction($id){
        $estat = $this->getDoctrine()->getRepository('HotelBundle:Estat')->findOneById($id);

        if ($estat != null) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($estat);
            $em->flush();
            $this->get('session')->getFlashBag()->add(
                    'notice',array(
                    'type' => 'success',
                    'msg' => 'S\'ha eliminat l\'estat'
            ));
        }else{
            $this->get('session')->getFlashBag()->add(
                    'notice',array(
                    'type' => 'danger',
                    'msg' => 'No s\'ha eliminat l\'estat'
            ));
        }
        return $this->redirect($this->generateurl('hotel_bundle_estat_homepage'));
    }

}