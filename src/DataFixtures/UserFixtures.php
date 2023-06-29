<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture //implements DependentFixtureInterface
{
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        for ($userIterator = 0; $userIterator < 10; $userIterator++) {
            $user = new User();
            $user
                ->setEmail($faker->email())
                ->setPassword($this->passwordHasher->hashPassword($user, 'password'))
                ->setFirstname($faker->firstName())
                ->setLastname($faker->lastName())
                ->setPhoneNumber($faker->phoneNumber())
                ->setCreatedAt(new \DateTime())
                ->setUpdatedAt(new \DateTime());

            if ($userIterator === 9) {
                $user->setRoles(['ROLE_ADMIN']);
            }

            $manager->persist($user);
        }

        $manager->flush();
    }
}