<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Entity\User;

class UserFixtures extends Fixture
{
     private $passwordEncoder;

     public function __construct(UserPasswordEncoderInterface $passwordEncoder)
     {
         $this->passwordEncoder = $passwordEncoder;
     }

    public function load(ObjectManager $manager)
    {
        $user1 = new User();
        $user1->setEmail('matt.smith@smith.com');
        $passwordPlain = 'smith';
        $encodedPassword = $this->passwordEncoder->encodePassword($user1,  $passwordPlain);
        $user1->setPassword($encodedPassword);
        $user1->setRoles(['ROLE_USER', 'ROLE_ADMIN']);

        $manager->persist($user1);

         // add new objects to DB
        $manager->flush();
    }
}