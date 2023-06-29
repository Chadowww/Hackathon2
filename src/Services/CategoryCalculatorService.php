<?php

namespace App\Services;

use App\Entity\Memory;
use App\Entity\PhoneAge;
use App\Entity\PhoneCondition;
use App\Entity\Storage;
use App\Repository\CategoryRepository;
use App\Repository\MemoryRepository;
use App\Repository\SmartphoneRepository;
use App\Repository\YearRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;

class CategoryCalculatorService
{

    public Storage $storage;
    public Memory $memory;
    public PhoneAge $age;
    public PhoneCondition $phoneCondition;

    public function __construct(
        SmartphoneRepository $smartphoneRepository,
        APIServices $apiServices,
        YearRepository $phoneAge,
        CategoryRepository $categoryRepository,
        EntityManagerInterface $manager,
        MemoryRepository $memoryRepository,
    )
    {
        $this->smartphoneRepository = $smartphoneRepository;
        $this->apiServices = $apiServices;
        $this->phoneAge = $phoneAge;
        $this->memory = new Memory();
        $this->storage = new Storage();
        $this->age = new PhoneAge();
        $this->phoneCondition = new PhoneCondition();
        $this->categoryRepository = $categoryRepository;
        $this->manager = $manager;
        $this->memoryRepository = $memoryRepository;
    }

    public function calculateCategory($id)
    {
        $smartphones = $this->smartphoneRepository->findBy(['id' => $id]);
        $categories = $this->categoryRepository->findAll();

        $yearRelease = $smartphones[0]->getReleaseDate();
        $yearRelease = $yearRelease->format('Y');
        $currentlyYear = date('Y');
        $phoneAge = $currentlyYear - $yearRelease;

        $age = $this->phoneAge->findBy(['phoneAge' => $phoneAge]);

        $ram = $smartphones[0]->getMemory();
        $valueRam = $this->memoryRepository->findBy(['ramNumber' => $ram]);


        $condition = $smartphones[0]->getPhoneCondition();

        $storage = $smartphones[0]->getStorage();

        $valueAge = $age[0]->getValueYear();
        $valueRam = $valueRam[0]->getValueMemory();
        $valueStorage = $storage->getValueStorage();

        $totalValue = ($valueStorage + $valueRam + $valueAge) * $condition->getPriceDepreciation();

        foreach ($categories as $key => $value) {
            if ($totalValue >= $value->getIndiceMin() && $totalValue <= $value->getIndiceMax()) {
                $smartphones[0]->setCategory($value);
                $this->manager->persist($smartphones[0]);
                $this->manager->flush();
            }
        }

        return $totalValue;
    }
}