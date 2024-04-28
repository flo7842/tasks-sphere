<?php

namespace App\Tests;

use Zenstruck\Foundry\Test\Factories;
use Zenstruck\Foundry\Test\ResetDatabase;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;


class SigninTest extends KernelTestCase
{
    use ResetDatabase, Factories;

    public function testSignupUserIsSuccessfully() : void{

        self::bootKernel();
        $entityManager = static::$kernel->getContainer()
            ->get('doctrine')
            ->getManager();

        $user = new User();
        $user->setUsername('flo');
        $user->setPassword("flo");

        $entityManager->persist($user);
        $entityManager->flush();

        $insertedUser = $entityManager->getRepository(User::class)->findOneBy([
            'username' => 'flo',
        ]);

        self::assertNotNull($insertedUser);
        self::assertEquals('flo', $insertedUser->getUserName());
    }
}