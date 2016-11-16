<?php

namespace Esprit\RealEstateAgencyBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Esprit\RealEstateAgencyBundle\Entity\Mail;
use Swift_Message;
use Esprit\RealEstateAgencyBundle\Form\MailType;

class MailController extends Controller {

    public function indexAction() {
        return $this->render('EspritRealEstateAgencyBundle:Mail:mail.html.twig', array());
    }

    public function sendMail2CAction() {
        $to = "esprit.3a15.realestateagency@gmail.com";
        $mail = new Mail();
        $request = $this->get('request');
        $form = $this->createForm(new MailType(), $mail);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $message = Swift_Message::newInstance()
                    ->setSubject($mail->getSujet())
                    ->setFrom($to)
                    ->setTo($mail->getTo())
                    ->setBody($mail->getText());
            $this->get('mailer')->send($message);
            return $this->render('EspritRealEstateAgencyBundle:Mail:mail.html.twig'
            );
        }
        return $this->render('EspritRealEstateAgencyBundle:Mail:mail.html.twig', array('form' => $form->createView()));
    }

    public function Admin2ClientAction() {
        $mail = new Mail();
        $rea = "esprit.3a15.realestateagency@gmail.com";
        $form = $this->container->get('form.factory')->create(new MailType(), $mail);
        $request = $this->getRequest();
        if ($request->getMethod() == 'POST') {
            $form->bind($request);
            if ($form->isValid()) {
                $this->sendMail2CAction($rea, $mail->getTo(), $mail->getSujet(), $mail->getText());
            }
        }
        return $this->render('EspritRealEstateAgencyBundle:Mail:mail2Client.html.twig', array('form' => $form->createView()));
    }

 
 
}
