<?php

namespace App\DataFixtures;

use App\Entity\PhoneCondition;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class PhoneConditionFixtures extends Fixture
{
    const PHONECONDITIONS = [
        [
            'overall_condition' => "Parfait état",
            'price_depreciation' => 1,
        ],
        [
            'overall_condition' => "Bon état",
            'price_depreciation' => 0.8,
        ],
        [
            'overall_condition' => "Êtat correct",
            'price_depreciation' => 0.6,
        ],
        [
            'overall_condition' => "A vécu",
            'price_depreciation' => 0.4,
        ]
    ];

    public function load(ObjectManager $manager)
    {
        foreach (self::PHONECONDITIONS as $phoneCondition) {
            $phoneConditionForFixture = new PhoneCondition();
            $phoneConditionForFixture ->setOverallCondition($phoneCondition ['overall_condition']);
            $phoneConditionForFixture ->setPriceDepreciation($phoneCondition ['price_depreciation']);
            $phoneConditionForFixture ->setCreatedAt(new \DateTime());
            $phoneConditionForFixture ->setUpdatedAt(new \DateTime());
            $this->setReference('phone_condition_' . $phoneCondition['overall_condition'], $phoneConditionForFixture);

            $manager->persist($phoneConditionForFixture);
        }
        $manager->flush();
    }
}