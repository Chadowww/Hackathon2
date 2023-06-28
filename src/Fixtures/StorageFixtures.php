<?php

namespace App\Fixtures;

use App\Entity\Storage;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class StorageFixtures extends Fixture
{

    const STORAGEVALUES = [
        [
            'go_storage' => 2,
            'value_storage' => 0,
        ],
        [
            'go_storage' => 4,
            'value_storage' => 10,
        ],
        [
            'go_storage' => 8,
            'value_storage' => 20,
        ],
        [
            'go_storage' => 16,
            'value_storage' => 30,
        ],
        [
            'go_storage' => 32,
            'value_storage' => 50,
        ],
        [
            'go_storage' => 64,
            'value_storage' => 70,
        ],
        [
            'go_storage' => 128,
            'value_storage' => 80,
        ],
        [
            'go_storage' => 256,
            'value_storage' => 90,
        ],
        [
            'go_storage' => 512,
            'value_storage' => 100,
        ],
        [
            'go_storage' => 1000,
            'value_storage' => 120,
        ]
    ];

    public function load(ObjectManager $manager)
    {
        foreach (self::STORAGEVALUES as $storage) {
            $storageForFixture = new Storage();
            $storageForFixture ->setGoStorage($storage ['go_storage']);
            $storageForFixture ->setValueStorage($storage ['value_storage']);
            $storageForFixture ->setCreatedAt(new \DateTime());
            $storageForFixture ->setUpdatedAt(new \DateTime());

            $manager->persist($storageForFixture);
        }
        $manager->flush();
    }
}