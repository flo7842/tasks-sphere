<?php

namespace App\Service;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class RegisterService {

    private $passwordHasher;
    private $em;

    public function __construct(
        EntityManagerInterface $em,
        UserPasswordHasherInterface $passwordHasher
    ) {
        $this->passwordHasher = $passwordHasher;
        $this->em = $em;
    }

    public function register(User $user){
        $user->setPassword($this->passwordHasher->hashPassword($user, $user->getPassword()));
        $this->em->persist($user);
        $this->em->flush();
    }

    
}
