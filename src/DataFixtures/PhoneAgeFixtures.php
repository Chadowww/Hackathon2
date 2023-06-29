<?php

namespace App\DataFixtures;

use App\Entity\PhoneAge;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class PhoneAgeFixtures extends Fixture
{
    const YEARVALUES = [
        [
            'phone_age' => 1,
            'value_year' => 110,
        ],
        [
            'phone_age' => 2,
            'value_year' => 100,
        ],
        [
            'phone_age' => 3,
            'value_year' => 90,
        ],
        [
            'phone_age' => 4,
            'value_year' => 80,
        ],
        [
            'phone_age' => 5,
            'value_year' => 70,
        ],
        [
            'phone_age' => 6,
            'value_year' => 60,
        ],
        [
            'phone_age' => 7,
            'value_year' => 50,
        ],
        [
            'phone_age' => 8,
            'value_year' => 40,
        ],
        [
            'phone_age' => 9,
            'value_year' => 30,
        ],
        [
            'phone_age' => 10,
            'value_year' => 20,
        ],
        [
            'phone_age' => 11,
            'value_year' => 10,
        ]
    ];

    public function load(ObjectManager $manager)
    {
        foreach (self::YEARVALUES as $year) {
            $yearForFixture = new PhoneAge();
            $yearForFixture ->setPhoneAge($year ['phone_age']);
            $yearForFixture ->setvalueYear($year ['value_year']);
            $yearForFixture ->setCreatedAt(new \DateTime());
            $yearForFixture ->setUpdatedAt(new \DateTime());

            $manager->persist($yearForFixture);
        }
        $manager->flush();
    }
}