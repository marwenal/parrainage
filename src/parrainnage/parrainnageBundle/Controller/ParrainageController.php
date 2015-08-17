<?php

namespace parrainnage\parrainnageBundle\Controller;
use parrainnage\parrainnageBundle\Entity\Parrainage;
use parrainnage\parrainnageBundle\Entity\Invitation;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
class ParrainageController extends Controller{
    public function IndexAction() {
        $food = new Parrainage();
$food->setTitle('Food');

$fruits = new Parrainage();
$fruits->setTitle('Fruits');
$fruits->setParent($food);

$vegetables = new Parrainage();
$vegetables->setTitle('Vegetables');
$vegetables->setParent($food);

$carrots = new Parrainage();
$carrots->setTitle('Carrots');
$carrots->setParent($vegetables);
$em=  $this->getEventManager()->getListeners();
//$entities = $em->getRepository('parrainnageBundle:Parrainage')->findAll();
$this->$em->persist($food);
$this->$em->persist($fruits);
$this->$em->persist($vegetables);
$this->$em->persist($carrots);
$this->$em->flush();

    }
}
