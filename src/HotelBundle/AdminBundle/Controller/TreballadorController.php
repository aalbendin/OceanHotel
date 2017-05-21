<?php

namespace HotelBundle\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use HotelBundle\Entity\TipusTreballador;
use HotelBundle\Entity\Treballador;
use HotelBundle\Entity\User;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class TreballadorController extends Controller
{
    public function indexAction(){
        $Treballadors = $this->getDoctrine()->getRepository('HotelBundle:Treballador')->findAll();

        return $this->render('HotelBundleAdminBundle:Default:llistaTreballador.html.twig', array(
            'array' => $Treballadors
            ));
    }

    public function addTreballadorAction(Request $request)
    {
        $Treballador = new Treballador();

        $form = $this->createFormBuilder($Treballador)
        ->add('nom', TextType::class, array('label' => 'Nom','attr' => array(
            'class' => 'form-control'),
        'label_attr'=> array('class' => 'label_text spaceTop')))  
        ->add('cognoms', TextType::class, array('label' => 'Cognoms','attr' => array(
            'class' => 'form-control'),
        'label_attr'=> array('class' => 'label_text spaceTop'))) 
        ->add('dataNaiximent', DateType::class, array('label' => 'Data Naixement',
            'widget' => 'single_text',
            'html5' => false,
            'format' => 'dd/mm/yyyy',
            'attr' => ['class' => 'js-datepicker']))
        ->add('nif', TextType::class, array('label' => 'Nif','attr' => array(
            'class' => 'form-control'),
        'label_attr'=> array('class' => 'label_text spaceTop')))
        ->add('usuari', EntityType::class, array(
            'class' => 'HotelBundle:User',
            'choice_label' => 'username',
            'multiple' => FALSE,
            'label_attr'=> array('class' => 'label_text spaceTop'), 
            'attr' => array('class' => 'form-control selectRol')))
        ->add('tipusTreballador', EntityType::class, array(
            'class' => 'HotelBundle:TipusTreballador',
            'choice_label' => 'descripcio',
            'multiple' => FALSE,
            'label_attr'=> array('class' => 'label_text spaceTop'), 
            'attr' => array('class' => 'form-control selectRol')))          
        ->add('save', SubmitType::class, array('label' => 'Crear Treballador',
            'attr' => array(
                'class' => 'btn btn-warning mt')))
        ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user  = $this->getDoctrine()->getRepository('HotelBundle:User')->findOneById($Treballador->getUsuari());
            
            if(!$this->existeix($Treballador)){
                $user->addRole('ROLE_TREBALLADOR');
                $em = $this->getDoctrine()->getManager();
                $em->persist($Treballador);
                $em->flush();

                $this->get('session')->getFlashBag()->add(
                    'notice',array(
                        'type' => 'success',
                        'msg' => 'S\'ha afegit el Treballador'
                        )); 
                return $this->redirect($this->generateurl('hotel_bundle_llistaTreballador'));
            }else{
                $this->get('session')->getFlashBag()->add(
                    'notice',array(
                        'type' => 'danger',
                        'msg' => 'Aquest Treballador ja existeix!'
                        )); 
            }            
        };

        return $this->render('HotelBundleAdminBundle:Default:addObject.html.twig', array(
            'titol' => 'Afegir Treballador',
            'form' => $form->createView()
            ));
    }

    public function editTreballadorAction($id,Request $request)
    {
        $Treballador = $this->getDoctrine()->getRepository('HotelBundle:Treballador')->findOneById($id);
        $user1 = $this->getDoctrine()->getRepository('HotelBundle:User')->findOneById($Treballador->getUsuari()->getId());

        $form = $this->createFormBuilder($Treballador)
        ->add('nom', TextType::class, array('label' => 'Nom','attr' => array(
            'class' => 'form-control'),
        'label_attr'=> array('class' => 'label_text spaceTop')))  
        ->add('cognoms', TextType::class, array('label' => 'Cognoms','attr' => array(
            'class' => 'form-control'),
        'label_attr'=> array('class' => 'label_text spaceTop'))) 
        ->add('dataNaiximent', DateType::class, array('label' => 'Data Naixement',
            'widget' => 'single_text',
            'html5' => false,
            'format' => 'dd/mm/yyyy',
            'attr' => ['class' => 'js-datepicker']))
        ->add('nif', TextType::class, array('label' => 'Nif','attr' => array(
            'class' => 'form-control'),
        'label_attr'=> array('class' => 'label_text spaceTop')))
        ->add('usuari', EntityType::class, array(
            'class' => 'HotelBundle:User',
            'choice_label' => 'username',
            'multiple' => FALSE,
            'label_attr'=> array('class' => 'label_text spaceTop'), 
            'attr' => array('class' => 'form-control selectRol')))
        ->add('tipusTreballador', EntityType::class, array(
            'class' => 'HotelBundle:TipusTreballador',
            'choice_label' => 'descripcio',
            'multiple' => FALSE,
            'label_attr'=> array('class' => 'label_text spaceTop'), 
            'attr' => array('class' => 'form-control selectRol')))          
        ->add('save', SubmitType::class, array('label' => 'Crear Treballador',
            'attr' => array(
                'class' => 'btn btn-warning mt')))
        ->getForm();


        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            if(!$this->existeix($Treballador)){
                $user2  = $this->getDoctrine()->getRepository('HotelBundle:User')->findOneById($Treballador->getUsuari());
                if($user1->getId() != $user2->getId()){
                    $user1->removeRole('ROLE_TREBALLADOR');
                    $user2->addRole('ROLE_TREBALLADOR');
                }

                $em = $this->getDoctrine()->getManager();
                $em->persist($Treballador);
                $em->flush();

                $this->get('session')->getFlashBag()->add(
                    'notice',array(
                        'type' => 'success',
                        'msg' => 'S\'ha editat el Treballador'
                        ));            
                return $this->redirect($this->generateurl('hotel_bundle_llistaTreballador'));
            }else{
                $this->get('session')->getFlashBag()->add(
                    'notice',array(
                        'type' => 'danger',
                        'msg' => 'Aquest Treballador ja existeix!'
                        )); 
            }
        };

        return $this->render('HotelBundleAdminBundle:Default:addObject.html.twig', array(
            'titol' => 'Editar Treballador',
            'form' => $form->createView()
            ));
    }

    public function deleteTreballadorAction($id){
        $Treballador = $this->getDoctrine()->getRepository('HotelBundle:Treballador')->findOneById($id);

        if ($Treballador != null) {
            $user  = $this->getDoctrine()->getRepository('HotelBundle:User')->findOneById($Treballador->getUsuari());
            $user->removeRole('ROLE_TREBALLADOR'); 
            $em = $this->getDoctrine()->getManager();
            $em->remove($Treballador);
            $em->flush();
            $this->get('session')->getFlashBag()->add(
                'notice',array(
                    'type' => 'success',
                    'msg' => 'S\'ha eliminat el treballador'
                    ));
        }else{
            $this->get('session')->getFlashBag()->add(
                'notice',array(
                    'type' => 'danger',
                    'msg' => 'No s\'ha eliminat el treballador'
                    ));
        }
        return $this->redirect($this->generateurl('hotel_bundle_llistaTreballador'));
    }

    public function existeix($Treballador){
        $Treballadors = $this->getDoctrine()->getRepository('HotelBundle:Treballador')->findAll();
        foreach ($Treballadors as $treb) {
            if($treb->getUsuari()->getId() == $Treballador->getUsuari()->getId()){
                return true;
            }
        }
        return false;
    }

}