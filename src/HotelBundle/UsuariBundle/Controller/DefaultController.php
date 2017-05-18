<?php

namespace HotelBundle\UsuariBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction(){
    	$usuari = $this->getDoctrine()->getRepository('HotelBundle:User')->findAll();
        return $this->render('HotelBundleUsuariBundle:Default:llista.html.twig', array(
                    'array' => $usuari
        ));
    }

    public function editAction($id,Request $request){
        $usuari = $this->getDoctrine()->getRepository('HotelBundle:User')->findOneById($id);
        $form = $this->createFormBuilder($usuari)
            ->add('username', TextType::class, array('label' => 'Nom d\'usuari','attr' => array(
                    'class' => 'form-control'),
                    'label_attr'=> array('class' => 'label_text spaceTop')))  
            ->add('email', EmailType::class, array('label' => 'Email','attr' => array(
                    'class' => 'form-control'),
                    'label_attr'=> array('class' => 'label_text spaceTop')))    
            ->add('password', PasswordType::class, array('label' => 'Password','attr' => array(
                    'class' => 'form-control'),
                    'label_attr'=> array('class' => 'label_text spaceTop')))    
            ->add('roles', ChoiceType::class, array('label' => 'Rol', 
            'attr' => ['class' => 'selectRol'],
            'required' => true, 'choices' => array("Treballador" => 'ROLE_TREBALLADOR', "Administrador" => 'ROLE_ADMIN', "Usuari" => 'ROLE_USER'), 'multiple' => true))
            ->add('save', SubmitType::class, array('label' => 'Editar Usuari',
                    'attr' => array(
                        'class' => 'btn btn-warning mt')))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {            
            $em = $this->getDoctrine()->getManager();

            $password = $usuari->getPassword();
            $encoder = $this->container->get('security.password_encoder');
            $passwordEncrypt = $encoder->encodePassword($usuari, $password);
            $usuari->setPassword($passwordEncrypt);
            $em->persist($usuari);
            $em->flush();

            $this->get('session')->getFlashBag()->add(
                    'notice',array(
                    'type' => 'success',
                    'msg' => 'S\'ha editat l\'usuari'
            ));
            return $this->redirect($this->generateurl('hotel_bundle_usuari_homepage'));
        };
 
        return $this->render('HotelBundleAdminBundle:Default:addObject.html.twig', array(
            'titol' => 'Editar Usuari',
            'form' => $form->createView()
        ));
    }

    public function deleteAction($id){
    	$usuari = $this->getDoctrine()->getRepository('HotelBundle:User')->findOneById($id);
    	echo $usuari;
    	if ($usuari != null) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($usuari);
            $em->flush();
            $this->get('session')->getFlashBag()->add(
                    'notice',array(
                    'type' => 'success',
                    'msg' => 'S\'ha eliminat l\'usuari'
            ));
        }else{
            $this->get('session')->getFlashBag()->add(
                    'notice',array(
                    'type' => 'danger',
                    'msg' => 'No s\'ha eliminat l\'usuari'
            ));
        }
        $arrayUsuari = $this->getDoctrine()->getRepository('HotelBundle:User')->findAll();
        return $this->render('HotelBundleUsuariBundle:Default:llista.html.twig', array(
                    'array' => $arrayUsuari
        ));
    }
}
