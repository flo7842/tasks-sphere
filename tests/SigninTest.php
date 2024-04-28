<?php

namespace App\Tests;

use Zenstruck\Foundry\Test\Factories;
use Zenstruck\Foundry\Test\ResetDatabase;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;


class SigninTest extends KernelTestCase
{
    use ResetDatabase, Factories;

    public function testProductIsInsertedSuccessfully() : void{

        self::bootKernel();
        $entityManager = static::$kernel->getContainer()
            ->get('doctrine')
            ->getManager();

        $user = new User();
        $user->setUsername('flo');
        $user->setPassword("floooo");

        $entityManager->persist($user);
        $entityManager->flush();

        $insertedProduct = $entityManager->getRepository(User::class)->findOneBy([
            'username' => 'flo',
        ]);

        self::assertNotNull($insertedProduct);
        self::assertEquals('flo', $insertedProduct->getUserName());


    }
}