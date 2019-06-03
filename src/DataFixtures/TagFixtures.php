<?php

namespace App\DataFixtures;

use App\Entity\Tag;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class TagFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);

        $tags = ["php","javascript","react.js","react native","vue.js","angular","node.js","mongodb","sql","mysql"];

        foreach ($tags as $tag) {
            $t = new Tag();
            $t->setNom($tag);
            //equivalent du save de laravel et persist prepare la requete
            $manager->persist($t);
        }
        // flush execute en une seule fois
        $manager->flush();
    }
}
