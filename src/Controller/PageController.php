<?php

namespace App\Controller;

use App\Repository\ModelRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ContentRepository;

class PageController extends AbstractController
{
    #[Route('/{token}', name: 'app_page', requirements: ["token"=> ".+\/$"])]
    public function index(
        string $token,
        ModelRepository $modelRepository,
        ContentRepository $contentRepository
    ): Response
    {
        return $this->render('page/index.html.twig', [
            'controller_name' => 'PageController',
            'models_menu' => $modelRepository->findAllWithPathForMenu(),
            'page' => $contentRepository->findPageByPath(trim($token, '/'))
        ]);
    }
}
