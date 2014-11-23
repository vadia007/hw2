<?php

namespace Acme\hw2Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Acme\hw2Bundle\Entity\Car;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    public function createAction()
    {
        $car = new Car();
        $car->setName('Ford');
        $car->setSpeed(200);

        $em = $this->getDoctrine()->getManager();
        $em->persist($car);
        $em->flush();

        return new Response('Created car id '.$car->getId());
    }

    public function showAction($id)
    {
        $car = $this->getDoctrine()
            ->getRepository('Acmehw2Bundle:Car')
            ->find($id);

        if (!$car) {
            throw $this->createNotFoundException(
                'No car found for id '.$id
            );
        }

        return $car;
    }

    public function indexAction($id)
    {
        $this->createAction();
        $car = $this->showAction($id);
        return $this->render('Acmehw2Bundle:Default:index.html.twig', array('car' => $car));
    }
}
