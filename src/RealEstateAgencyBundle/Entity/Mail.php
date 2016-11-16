<?php

namespace Esprit\RealEstateAgencyBundle\Entity;

class Mail {

    private $sujet, $to, $text;

    function getSujet() {
        return $this->sujet;
    }

    function getTo() {
        return $this->to;
    }

    function getText() {
        return $this->text;
    }

    function setSujet($sujet) {
        $this->sujet = $sujet;
    }

    function setTo($to) {
        $this->to = $to;
    }

    function setText($text) {
        $this->text = $text;
    }

}
