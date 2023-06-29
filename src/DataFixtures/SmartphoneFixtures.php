<?php

namespace App\DataFixtures;

use App\Entity\Smartphone;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class SmartphoneFixtures extends Fixture implements DependentFixtureInterface
{
    const SMARTPHONES = [
        [
            'is_sold' => 0,
            'has_charger' => 1,
            'category_code' => '1-HC',
        ],
        [
            'is_sold' => 0,
            'has_charger' => 1,
            'category_code' => '2-C',
        ],
        [
            'is_sold' => 0,
            'has_charger' => 1,
            'category_code' => '3-B',
        ],
        [
            'is_sold' => 0,
            'has_charger' => 1,
            'category_code' => '4-A',
        ],
        [
            'is_sold' => 0,
            'has_charger' => 1,
            'category_code' => '5-Premium',
        ]
    ];

    public function load(ObjectManager $manager)
    {
        $i = 1;
        foreach (self::SMARTPHONES as $smartphone) {
            $faker = Factory::create('fr_FR');
            $smartphoneForFixture = new Smartphone();
            $smartphoneForFixture ->setmodel($faker->word);
            $smartphoneForFixture ->setHasCharger($smartphone ['has_charger']);
            $smartphoneForFixture ->setIsSold($smartphone ['is_sold']);
            $smartphoneForFixture ->setCategory($this->getReference('category_' . $smartphone['category_code']));
            $smartphoneForFixture ->setMemory($this->getReference('memory_' . $i));
            $smartphoneForFixture ->setStorage($this->getReference('storage_' . $i));
            $smartphoneForFixture ->setCreatedAt(new \DateTime());
            $smartphoneForFixture ->setUpdatedAt(new \DateTime());

            $i++;
            $manager->persist($smartphoneForFixture);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            CategoryFixtures::class,
            MemoryFixtures::class,
            StorageFixtures::class,
        ];
    }
}