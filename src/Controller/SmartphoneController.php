<?php

namespace App\Controller;

use App\Entity\Smartphone;
use App\Form\SearchSmartphoneType;
use App\Form\SmartphoneType;
use App\Repository\SmartphoneRepository;
use App\Services\APIServices;
use App\Services\CategoryCalculatorService;
use DateTimeImmutable;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/smartphone')]
class SmartphoneController extends AbstractController
{
    #[Route('/', name: 'app_smartphone_index', methods: ['GET', 'POST'])]
    public function index(Request $request, SmartphoneRepository $smartphoneRepository): Response
    {
        $form = $this->createForm(SearchSmartphoneType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $search = $form->getData()['search'];
            $smartphones = $smartphoneRepository->findLikeModel($search);
        } else {
            $smartphones = $smartphoneRepository->findAll();
        }
        return $this->render('smartphone/index.html.twig', [
            'smartphones' => $smartphones,
            'form' => $form,
        ]);
    }

    #[Route('/new', name: 'app_smartphone_new', methods: ['GET', 'POST'])]
    public function new(
        Request $request,
        SmartphoneRepository $smartphoneRepository,
        APIServices $APIServices,
        CategoryCalculatorService $categoryCalculatorService): Response
    {
        $smartphone = new Smartphone();
        $form = $this->createForm(SmartphoneType::class, $smartphone);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $apiServices = new APIServices();
            $resultRequest = $apiServices->getIdProduct($form->get('model')->getData());

            $idAPI= $resultRequest['data']['items'][0]['product']['id'];
            $phone= $apiServices->getDetailsProduct($idAPI);

            $wireless = $phone['data']['items'][0]['key_aspects']['wireless_&_cellular'];
            if(!preg_match("/\b(?:4G|5G|6G)\b/", $wireless))
            {
                $this->addFlash('error', 'Ce téléphone n\'est pas compatible nos critères de reprise');
                return $this->redirectToRoute('app_smartphone_new');
            }

            $memory = $phone['data']['items'][0]['key_aspects']['ram'];
            $numericValue = intval(preg_replace('/[^0-9]/', '', $memory));
            $releaseDate = $phone['data']['items'][0]['date']['released'];
            $date = DateTimeImmutable::createFromFormat('Y-m-d', $releaseDate);

            $smartphone->setmodel($form->get('model')->getData());
            $smartphone->sethasCharger($form->get('hasCharger')->getData());
            $smartphone->setstorage($form->get('storage')->getData());
            $smartphone->setMemory($numericValue);
            $smartphone->setReleaseDate($date);
            $smartphone->setPhoneCondition($form->get('phoneCondition')->getData());
            $smartphone->setIsSold(0);
            $smartphone->setCreatedAt(new \DateTime());
            $smartphone->setUpdatedAt(new \DateTime());


            $smartphoneRepository->save($smartphone, true);

            $id = $smartphone->getId();
            $categoryCalculatorService->calculateCategory($id);

            return $this->redirectToRoute('app_smartphone_show', [
                'id' => $id,
                'smartphone' => $smartphone,
            ], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('smartphone/new.html.twig', [
            'smartphone' => $smartphone,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_smartphone_show', methods: ['GET'])]
    public function show(Smartphone $smartphone, APIServices $APIServices): Response
    {
        $id = 'hello';
        $details = $APIServices->getDetailsProduct($id);
        return $this->render('smartphone/show.html.twig', [
            'smartphone' => $smartphone,
            'details' => $details,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_smartphone_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Smartphone $smartphone, SmartphoneRepository $smartphoneRepository): Response
    {
        $form = $this->createForm(SmartphoneType::class, $smartphone);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $smartphoneRepository->save($smartphone, true);

            return $this->redirectToRoute('app_smartphone_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('smartphone/edit.html.twig', [
            'smartphone' => $smartphone,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_smartphone_delete', methods: ['POST'])]
    public function delete(Request $request, Smartphone $smartphone, SmartphoneRepository $smartphoneRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$smartphone->getId(), $request->request->get('_token'))) {
            $smartphoneRepository->remove($smartphone, true);
        }

        return $this->redirectToRoute('app_smartphone_index', [], Response::HTTP_SEE_OTHER);
    }
}
