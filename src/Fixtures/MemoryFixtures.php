<?php

namespace App\Fixtures;

use App\Entity\Memory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class MemoryFixtures extends Fixture
{
    const MEMORYVALUES = [
        [
            'ram_number' => 1,
            'value_memory' => 0,
        ],
        [
            'ram_number' => 2,
            'value_memory' => 10,
        ],
        [
            'ram_number' => 3,
            'value_memory' => 20,
        ],
        [
            'ram_number' => 4,
            'value_memory' => 30,
        ],
        [
            'ram_number' => 5,
            'value_memory' => 40,
        ],
        [
            'ram_number' => 6,
            'value_memory' => 50,
        ],
        [
            'ram_number' => 7,
            'value_memory' => 60,
        ],
        [
            'ram_number' => 8,
            'value_memory' => 70,
        ],
        [
            'ram_number' => 9,
            'value_memory' => 80,
        ],
        [
            'ram_number' => 10,
            'value_memory' => 90,
        ],
        [
            'ram_number' => 11,
            'value_memory' => 100,
        ],
        [
            'ram_number' => 12,
            'value_memory' => 110,
        ],
        [
            'ram_number' => 13,
            'value_memory' => 120,
        ],
        [
            'ram_number' => 14,
            'value_memory' => 130,
        ],
        [
            'ram_number' => 15,
            'value_memory' => 140,
        ],
        [
            'ram_number' => 16,
            'value_memory' => 150,
        ],
        [
            'ram_number' => 17,
            'value_memory' => 160,
        ],
        [
            'ram_number' => 18,
            'value_memory' => 170,
        ]
    ];

    public function load(ObjectManager $manager)
    {
        foreach (self::MEMORYVALUES as $memory) {
            $memoryForFixture = new Memory();
            $memoryForFixture ->setRamNumber($memory ['ram_number']);
            $memoryForFixture ->setValueMemory($memory ['value_memory']);
            $memoryForFixture ->setCreatedAt(new \DateTime());
            $memoryForFixture ->setUpdatedAt(new \DateTime());

            $manager->persist($memoryForFixture);
        }
        $manager->flush();
    }
}