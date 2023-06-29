<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    const CATEGORIES = [
        [
            'indice_min' => 300,
            'indice_max' => 1000,
            'category_code' => "5-Premium",
            'price' => 55,
        ],
        [
            'indice_min' => 250,
            'indice_max' => 299,
            'category_code' => "4-A",
            'price' => 40,
        ],
        [
            'indice_min' => 200,
            'indice_max' => 249,
            'category_code' => "3-B",
            'price' => 30,
        ],
        [
            'indice_min' => 150,
            'indice_max' => 199,
            'category_code' => "2-C",
            'price' => 20,
        ],
        [
            'indice_min' => 0,
            'indice_max' => 149,
            'category_code' => "1-HC",
            'price' => 10,
        ]
    ];

    public function load(ObjectManager $manager)
    {
        foreach (self::CATEGORIES as $category) {
            $categoryForFixture = new Category();
            $categoryForFixture ->setIndiceMin($category ['indice_min']);
            $categoryForFixture ->setIndiceMax($category ['indice_max']);
            $categoryForFixture ->setCategoryCode($category ['category_code']);
            $categoryCode = $categoryForFixture->getCategoryCode();
            $categoryForFixture ->setPrice($category ['price']);
            $categoryForFixture ->setCreatedAt(new \DateTime());
            $categoryForFixture ->setUpdatedAt(new \DateTime());

            $manager->persist($categoryForFixture);
            $this->addReference('category_' . $categoryCode, $categoryForFixture);
        }
        $manager->flush();
    }
}