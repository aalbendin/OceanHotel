<?php

namespace HotelBundle\UsuariBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction(){
    	$usuari = $this->getDoctrine()->getRepository('HotelBundle:User')->findAll();
        return $this->render('HotelBundleUsuariBundle:Default:llista.html.twig', array(
                    'array' => $usuari
        ));
    }

    public function editUserAction($id, Request $request){
    	$usuari = $this->getDoctrine()->getRepository('HotelBundle:User')->findById($id);

    	
    	$form = $this->createFormBuilder($usuari)
    		->add('username', TextType::class, array(
    			'label' => 'Nom \'usuari '
    	    ))
    		->add('email', EmailType::class, array(
    			'label' => 'Email '
    	    ))
    		->add('enabled', CheckboxType::class, array(
    			'label' => 'Actiu'
    	    ))
    		->add('password', PasswordType::class, array(
    			'label' => 'Password'
    		))
    		->add('save', SubmitType::class, array('label' => 'Editar Usuari',
                    'attr' => array(
                        'class' => 'btn btn-warning mt')))
            ->getForm();
    	
    	$form->handleRequest($request);

    	if ($form->isSubmitted() && $form->isValid()) {

            $usuari = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($usuari);
            $em->flush(); 

            $this->get('session')->getFlashBag()->add(
                    'notice',array(
                    'type' => 'success',
                    'msg' => 'S\'ha editat l\'usuari'
            ));
            return $this->redirect($this->generateurl('hotel_bundle_usuari_homepage'));
        }
        return $this->render('HotelBundleUsuariBundle:Default:form.html.twig', array(
                    'array' => $usuari,
                    'titol' => 'Editar usuari',
                    'form' => $form->createView()
        ));
    }
}
