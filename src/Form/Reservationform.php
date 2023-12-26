<?php

namespace App\Form;


use App\Entity\Modele;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
class Reservationform extends AbstractType{
    public function buildForm(FormBuilderInterface $builder, array $options):void
    {
    }
    public function getName(){
        return "Reservation" ;
    }
}