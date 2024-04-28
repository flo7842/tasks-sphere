<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ClearDatabaseFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // Replace User::class with your entity class if needed
        $repository = $manager->getRepository('App\Entity\User');
        $users = $repository->findAll();

        foreach ($users as $user) {
            $manager->remove($user);
        }

        $manager->flush();
    }
}
