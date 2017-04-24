<?php

namespace HotelBundle\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TipusTreballadorController extends Controller
{
    public function indexAction()
    {
        return $this->render('HotelBundle:Default:backend.html.twig');
    }

    public function addTipusTreballadorAction(Request $request)
    {
        // crea una categoria y le asigna algunos datos ficticios para este ejemplo
        $tipusTreballador = new TipusTreballador();
        // $category->setName('tato');
 
        $form = $this->createFormBuilder($tipusTreballador)
            ->add('descripcio', TextType::class, array('label' => 'Descripció','attr' => array(
                        'class' => 'form-control'),
                    'label_attr'=> array('class' => 'label_text spaceTop')))
            ->add('Rol', EntityType::class, array(
                'class' => 'HotelBundleBundle:Rol',
                'choice_label' => 'nameRol',
                'multiple' => FALSE,
                'label_attr'=> array('class' => 'label_text spaceTop'), 
                'attr' => array('class' => 'form-control')))
            ->add('save', SubmitType::class, array('label' => 'Crear Tipus Treballador' ,'attr' => array(
                        'class' => 'btn btn-primary spaceTop')))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $tipusTreballador = $form->getData();

            // ... perform some action, such as saving the task to the database
            // for example, if Category is a Doctrine entity, save it!
            $em = $this->getDoctrine()->getManager();
            $em->persist($tipusTreballador);
            $em->flush();

            return $this->render('HotelBundle:Default:backend.html.twig', array(
            'titol' => 'Nou Director afegit',
            'name' => $tipusTreballador->getName()));
        }
 
        return $this->render('HotelBundle:Default:backend.html.twig', array(
            'titol' => 'Afegir Director',
            'form' => $form->createView(),
        ));
    }

}