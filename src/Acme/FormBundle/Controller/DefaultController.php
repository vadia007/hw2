<?php

namespace Acme\FormBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Acme\FormBundle\Entity\Form;

class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {
        $form = new Form();

        $contactForm = $this->createFormBuilder($form)
            ->add('name', 'text')
            ->add('email', 'email')
            ->add('text', 'textarea')
            ->add('send', 'submit', array('label' => 'Send'))
            ->getForm();

        $contactForm->handleRequest($request);

        if ($contactForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($form);
            $em->flush();
        }

        return $this->render('AcmeFormBundle:Default:index.html.twig', array(
            'form' => $contactForm->createView(),
        ));

    }
}