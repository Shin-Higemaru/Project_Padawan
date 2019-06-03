<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private $userPasswordEncoder;

    public function __construct(UserPasswordEncoderInterface $userPasswordEncoder) {
        $this->userPasswordEncoder = $userPasswordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        $user = new User();
        $user->setPrenom('John');
        $user->setNom('Doe');
        $user->setBio("Je voit en noir et blanc");
        $user->setGithub("Shin-Higemaru");
        $user->setRoles(['ROLE_USER','ROLE_ADMIN']);
        $password = "123456789";
        $user->setPassword($this->userPasswordEncoder->encodePassword($user,$password));
        $user->setEmail("johndoe@gmail.com");
        $manager->persist($user);

        $user2 = new User();
        $user2->setPrenom('Johny');
        $user2->setNom('Wilkinson');
        $user2->setBio("Je suis tranchant");
        $user2->setGithub("Shin-Higemaru");
        $user2->setRoles(['ROLE_USER']);
        $password = "123456789";
        $user2->setPassword($this->userPasswordEncoder->encodePassword($user2,$password));
        $user2->setEmail("johnywilk@gmail.com");
        $manager->persist($user2);


        $manager->flush();
    }
}
