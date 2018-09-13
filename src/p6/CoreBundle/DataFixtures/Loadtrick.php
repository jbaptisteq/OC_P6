<?php

namespace p6\CoreBundle\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use p6\CoreBundle\Entity\Trick;
use p6\CoreBundle\Entity\Category;

class LoadTrick extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $list = array(
            array('name' => 'Mute', 'description' => 'Saisie de la carre frontside de la planche entre les deux pieds avec la main avant.', 'category_id' => 1, 'published' => 1),
            array('name' => 'Sad', 'description' => 'Saisie de la carre backside de la planche, entre les deux pieds, avec la main avant.', 'category_id' => 1, 'published' => 1),
            array('name' => 'Indy', 'description' => 'Saisie de la carre frontside de la planche, entre les deux pieds, avec la main arrière.', 'category_id' => 1, 'published' => 1),
            array('name' => 'Stalefish', 'description' => 'Saisie de la carre backside de la planche entre les deux pieds avec la main arrière.', 'category_id' => 1, 'published' => 1),
            array('name' => 'Tail grab', 'description' => 'Saisie de la partie arrière de la planche, avec la main arrière.', 'category_id' => 1, 'published' => 1),
            array('name' => 'Nose grab', 'description' => 'Saisie de la partie avant de la planche, avec la main avant.', 'category_id' => 1, 'published' => 1),
            array('name' => 'Japan', 'description' => 'Saisie de l\'avant de la planche, avec la main avant, du côté de la carre frontside.', 'category_id' => 1, 'published' => 1),
            array('name' => 'Seat belt', 'description' => 'Saisie du carre frontside à l\'arrière avec la main avant.', 'category_id' => 1, 'published' => 1),
            array('name' => 'Truck driver', 'description' => 'Saisie du carre avant et carre arrière avec chaque main (comme tenir un volant de voiture).', 'category_id' => 1, 'published' => 1),
            array('name' => '180', 'description' => 'Le principe est d\'effectuer une rotation horizontale pendant le saut, puis d\'attérir en position switch ou normal.', 'category_id' => 2, 'published' => 1),
            array('name' => '360', 'description' => 'Le principe est d\'effectuer une rotation horizontale pendant le saut, puis d\'attérir en position switch ou normal.', 'category_id' => 2, 'published' => 1),
            array('name' => '720', 'description' => 'Le principe est d\'effectuer une rotation horizontale pendant le saut, puis d\'attérir en position switch ou normal.', 'category_id' => 2, 'published' => 1)
        );

        foreach ($list as $line) {
            $trick = new Trick();
            $trick->setName($line['name']);
            $trick->setDescription($line['description']);
            $trick->setPublished($line['published']);

            // Chargement de l'entitée Category pour respecter l'index en base de donnée
            $category = $manager->getRepository('p6CoreBundle:Category')->findOneBy(array('id' => $line['category_id']));
            $trick->setCategory($category);

            $manager->persist($trick);
        }
        $manager->flush();
    }
}
