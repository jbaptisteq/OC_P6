<?php

namespace p6\CoreBundle\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use p6\CoreBundle\Entity\trick;

class Loadtrick extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $list = array(
            array('name' => 'Mute', 'description' => 'saisie de la carre frontside de la planche entre les deux pieds avec la main avant'),
            array('name' => 'Sad', 'description' => 'saisie de la carre backside de la planche, entre les deux pieds, avec la main avant'),
            array('name' => 'Indy', 'description' => 'saisie de la carre frontside de la planche, entre les deux pieds, avec la main arrière'),
            array('name' => 'Stalefish', 'description' => 'saisie de la carre backside de la planche entre les deux pieds avec la main arrière'),
            array('name' => 'Tail grab', 'description' => 'saisie de la partie arrière de la planche, avec la main arrière'),
            array('name' => 'Nose grab', 'description' => 'saisie de la partie avant de la planche, avec la main avant'),
            array('name' => 'Japan', 'description' => 'saisie de l\'avant de la planche, avec la main avant, du côté de la carre frontside'),
            array('name' => 'Seat belt', 'description' => 'saisie du carre frontside à l\'arrière avec la main avant'),
            array('name' => 'Truck driver', 'description' => 'saisie du carre avant et carre arrière avec chaque main (comme tenir un volant de voiture)')
        );

        foreach ($list as $line) {
            $trick = new trick();
            $trick->setName($line['name']);
            $trick->setDescription($line['description']);

            $manager->persist($trick);
        }

        $manager->flush();
    }
}
