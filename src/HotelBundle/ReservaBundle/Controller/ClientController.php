<?php

namespace HotelBundle\ReservaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\HttpFoundation\Request;
use HotelBundle\Entity\User;
use HotelBundle\Entity\Client;
 
class ClientController extends Controller
{
    public function indexAction(){
    	$clients = $this->getDoctrine()->getRepository('HotelBundle:Client')->findAll();
        return $this->render('HotelBundleReservaBundle:Default:llistaClients.html.twig', array(
                    'array' => $clients
        ));
    }

    public function afegirClientAction(Request $request)
    {
        $client = new Client;

         $form = $this->createFormBuilder($client)
            ->add('nom', TextType::class, array('label' => 'Nom','attr' => array(
                    'class' => 'form-control'),
                    'label_attr'=> array('class' => 'label_text spaceTop')))  
            ->add('cognoms', TextType::class, array('label' => 'Cognoms','attr' => array(
                    'class' => 'form-control'),
                    'label_attr'=> array('class' => 'label_text spaceTop'))) 
            ->add('dataNaixament', DateType::class, array('label' => 'Data Naixement',
            'widget' => 'single_text',
            'html5' => false,
            'format' => 'dd/mm/yyyy',
            'attr' => ['class' => 'js-datepicker'])) 
            ->add('nif', TextType::class, array('label' => 'NIF','attr' => array(
                    'class' => 'form-control'),
                    'label_attr'=> array('class' => 'label_text spaceTop')))  
            ->add('user', EntityType::class, array(
            'class' => 'HotelBundle:User',
            'label' => 'Usuari',
            'choice_label' => 'username',
            'multiple' => FALSE,
            'label_attr'=> array('class' => 'label_text spaceTop'), 
            'attr' => array('class' => 'form-control selectRol'))) 
            ->add('save', SubmitType::class, array('label' => 'Afegir Client',
                    'attr' => array(
                        'class' => 'btn btn-warning mt')))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($client);
            $em->flush();

            $this->get('session')->getFlashBag()->add(
                    'notice',array(
                    'type' => 'success',
                    'msg' => 'S\'ha afegit el Client Correctament'
            ));
            return $this->redirect($this->generateurl('hotel_bundle_admin_reserva_llistaClient'));
        };
 
        return $this->render('HotelBundleAdminBundle:Default:addObject.html.twig', array(
            'titol' => 'Afegir Client',
            'form' => $form->createView()
        ));
    }

    public function editarClientAction(Request $request , $id)
    {
        $client = $this->getDoctrine()->getRepository('HotelBundle:Client')->findOneById($id);

         $form = $this->createFormBuilder($client)
            ->add('nom', TextType::class, array('label' => 'Nom','attr' => array(
                    'class' => 'form-control'),
                    'label_attr'=> array('class' => 'label_text spaceTop')))  
            ->add('cognoms', TextType::class, array('label' => 'Cognoms','attr' => array(
                    'class' => 'form-control'),
                    'label_attr'=> array('class' => 'label_text spaceTop'))) 
            ->add('dataNaixament', DateType::class, array('label' => 'Data Naixement',
            'widget' => 'single_text',
            'html5' => false,
            'format' => 'dd/mm/yyyy',
            'attr' => ['class' => 'js-datepicker'])) 
            ->add('nif', TextType::class, array('label' => 'NIF','attr' => array(
                    'class' => 'form-control'),
                    'label_attr'=> array('class' => 'label_text spaceTop')))  
            ->add('user', EntityType::class, array(
            'class' => 'HotelBundle:User',
            'label' => 'Usuari',
            'choice_label' => 'username',
            'multiple' => FALSE,
            'label_attr'=> array('class' => 'label_text spaceTop'), 
            'attr' => array('class' => 'form-control selectRol'))) 
            ->add('save', SubmitType::class, array('label' => 'Editar Client',
                    'attr' => array(
                        'class' => 'btn btn-warning mt')))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($client);
            $em->flush();

            $this->get('session')->getFlashBag()->add(
                    'notice',array(
                    'type' => 'success',
                    'msg' => 'S\'ha editat el Client Correctament'
            ));
            return $this->redirect($this->generateurl('hotel_bundle_admin_reserva_llistaClient'));
        };
 
        return $this->render('HotelBundleAdminBundle:Default:addObject.html.twig', array(
            'titol' => 'Editar Client',
            'form' => $form->createView()
        ));
    }

    public function eliminarClientAction($id){
        $client = $this->getDoctrine()->getRepository('HotelBundle:Client')->findOneById($id);
    	$clientComandes = $this->getDoctrine()->getRepository('HotelBundle:Comanda')->findOneByClient($client);

    	if ($clientComandes == null) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($client);
            $em->flush();
            $this->get('session')->getFlashBag()->add(
                    'notice',array(
                    'type' => 'success',
                    'msg' => 'S\'ha eliminat el client'
            ));
        }else{
            $this->get('session')->getFlashBag()->add(
                    'notice',array(
                    'type' => 'danger',
                    'msg' => 'No es pot eliminar el client perque te reserves realitzades'
            ));
        }
        $arrayClient = $this->getDoctrine()->getRepository('HotelBundle:Client')->findAll();
        return $this->redirect($this->generateurl('hotel_bundle_admin_reserva_llistaClient', array(
                    'array' => $arrayClient
        )));

    }
}
