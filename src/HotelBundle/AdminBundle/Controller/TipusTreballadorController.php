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
            $rol->setDescripcio(strtoupper("ROLE_".$form->get('rol')->getData()));           
            $tipusTreballador->setDescripcio($form->get('descripcio')->getData());
            $tipusTreballador->setRolAsociat($rol);

            $em = $this->getDoctrine()->getManager();
            $em->persist($rol);
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
        $rol = $this->getDoctrine()->getRepository('HotelBundle:Rol')->findOneById($tipusTreb->getRolAsociat()->getId());

        $form = $this->createFormBuilder()
            ->add('descripcio', TextType::class, array('label' => 'Descripció','attr' => array(
                    'class' => 'form-control'),
                    'label_attr'=> array('class' => 'label_text spaceTop'),'data' => $tipusTreb->getDescripcio()))
            ->add('rol', TextType::class, array('label' => 'Rol','attr' => array(
                    'class' => 'form-control'),
                    'label_attr'=> array('class' => 'label_text spaceTop'),'data' => $rol->getDescripcio()))
            ->add('save', SubmitType::class, array('label' => 'Modificar Tipus Treballador' ,'attr' => array(
                        'class' => 'btn btn-primary spaceTop')))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $rol->setDescripcio($form->get('rol')->getData());           
            $tipusTreb->setDescripcio($form->get('descripcio')->getData());
            $tipusTreb->setRolAsociat($rol);

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
        $rol = $this->getDoctrine()->getRepository('HotelBundle:Rol')->findOneById($tipusTreb->getRolAsociat()->getId());

        if ($tipusTreb && $rol) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($tipusTreb);
            $em->remove($rol);
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