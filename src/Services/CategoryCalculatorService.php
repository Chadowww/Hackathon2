<?php

namespace App\Services;

use App\Entity\Memory;
use App\Entity\PhoneAge;
use App\Entity\Storage;
use App\Repository\CategoryRepository;
use App\Repository\SmartphoneRepository;
use App\Repository\YearRepository;
use Doctrine\Persistence\ObjectManager;

class CategoryCalculatorService
{

    public Storage $storage;
    public Memory $memory;
    public PhoneAge $age;

    public function __construct(
        SmartphoneRepository $smartphoneRepository,
        APIServices $apiServices,
        YearRepository $phoneAge,
        CategoryRepository $categoryRepository,
    )
    {
        $this->smartphoneRepository = $smartphoneRepository;
        $this->apiServices = $apiServices;
        $this->phoneAge = $phoneAge;
        $this->memory = new Memory();
        $this->storage = new Storage();
        $this->age = new PhoneAge();
        $this->categoryRepository = $categoryRepository;
    }

    public function calculateCategory($id)
    {
        $smartphones = $this->smartphoneRepository->findBy(['id' => $id]);

        $year = $smartphones[0]->getReleaseDate();
        $year = $year->format('Y');
        $yearNow = date('Y');
        $phoneAge = $yearNow - $year;

        $storage = $smartphones[0]->getStorage();
        $ram = $smartphones[0]->getMemory();
        $age = $this->phoneAge->findBy(['phoneAge' => $phoneAge]);

        $valueStorage = $storage->getValueStorage();
        $valueRam = $ram->getValueMemory();
        $valueAge = $age[0]->getValueYear();

        $totalValue = $valueStorage + $valueRam + $valueAge;

//        foreach ($category as $key => $value) {
//            if ($totalValue >= $value->getIndiceMin() && $totalValue <= $value->getIndiceMax()) {
//                $smartphones[0]->setCategory($value);
//                $this->manager->persist($smartphones[0]);
//                $this->manager->flush();
//            }
//        }



        return $totalValue;
    }
}