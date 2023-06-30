<?php

// src/Controller/ErrorController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class ErrorController extends AbstractController
{
    public function notFound(): Response
    {
        // Effectuez ici la logique de redirection souhaitée
        return $this->render('bundles/TwigBundle/Exception/error404.html.twig');
    }
}
