<?php

namespace HotelBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('HotelBundle:Default:index.html.twig');
    }

    public function backendAction() {
        $habitacions = $this->getDoctrine()->getRepository('HotelBundle:Habitacio')->findAll();
        $habitacions = count($habitacions);
        $treballadors = $this->getDoctrine()->getRepository('HotelBundle:Treballador')->findAll();
        $treballadors = count($treballadors);
        $reserves = $this->getDoctrine()->getRepository('HotelBundle:Reserva')->findAll();
        $reserves = count($reserves);
        $client = $this->getDoctrine()->getRepository('HotelBundle:Client')->findAll();
        $client = count($client);
        return $this->render('HotelBundle:Default:backend.html.twig', array(
                    'numHabitacions' => $habitacions,
                    'numTreballadors' => $treballadors,
                    'numReserves' => $reserves,
                    'numClient' => $client
        ));
    }

    public function UbicacioAction()
    {
        return $this->render('HotelBundle:public:ubicacio.html.twig');
    }

    public function contacteAction(Request $request) {
        //Formulari creat sense objectes
        $defaultData = array('message' => 'formulari de contacte');
        $form = $this->createFormBuilder($defaultData)
                ->add('Nom', TextType::class, array(
                    'label' => 'Nom:',
                    'attr' => array('class' => 'form-control'),
                    'constraints' => new Length(array('min' => 6)),))//validació
                ->add('Email', EmailType::class, array(
                    'label' => 'Email:',
                    'attr' => array('class' => 'form-control'),
                    'label_attr' => ['class' => 'mt'],
                ))
                ->add('Missatge', TextareaType::class, array(
                    'label' => 'Missatge:',
                    'label_attr' => ['class' => 'mt'],
                    'attr' => array('style' => 'height: 100px','class' => 'form-control')))
                ->add('Enviar', SubmitType::class, array('attr' => array(
                        'class' => 'btn btn-lg btn-warning mt btn-contact')))
                ->getForm();
        $form->handleRequest($request);
        if ($form->isValid()) {
            // les dades estàn dins d'un array amb les keys "nom", "email", i "missatges"
            $data = $form->getData();
        }
        // carrega la vista del formulari
        return $this->render('HotelBundle:Public:contacte.html.twig', array(
                    'form' => $form->createView()
        ));
    }
}
