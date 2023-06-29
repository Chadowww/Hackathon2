<?php

namespace App\Controller;

use App\Entity\Smartphone;
use App\Form\SmartphoneType;
use App\Repository\SmartphoneRepository;
use App\Services\APIServices;
use DateTimeImmutable;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/smartphone')]
class SmartphoneController extends AbstractController
{
    #[Route('/', name: 'app_smartphone_index', methods: ['GET'])]
    public function index(SmartphoneRepository $smartphoneRepository): Response
    {
        return $this->render('smartphone/index.html.twig', [
            'smartphones' => $smartphoneRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_smartphone_new', methods: ['GET', 'POST'])]
    public function new(Request $request, SmartphoneRepository $smartphoneRepository, APIServices $APIServices): Response
    {
        $smartphone = new Smartphone();
        $form = $this->createForm(SmartphoneType::class, $smartphone);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $apiServices = new APIServices();
            $resultRequest = $apiServices->getIdProduct($form->get('model')->getData());

            $idAPI= $resultRequest['data']['items'][0]['product']['id'];
            $phone= $apiServices->getDetailsProduct($idAPI);

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
            $smartphone->setCreatedAt(new \DateTime());
            $smartphone->setUpdatedAt(new \DateTime());


            $smartphoneRepository->save($smartphone, true);

            $id = $smartphone->getId();

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
