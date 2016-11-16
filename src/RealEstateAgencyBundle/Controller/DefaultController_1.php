<?php

namespace Esprit\RealEstateAgencyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('EspritRealEstateAgencyBundle:Default:index.html.twig', array());
    }
}
