<?php

namespace App\Controller;

use App\Repository\ModelRepository;
use App\Repository\SubmodelRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ContentRepository;

class PageController extends AbstractController
{
    /* Redirect to home page from /index */
    #[Route('/index')]
    public function redirect_to_main(): \Symfony\Component\HttpFoundation\RedirectResponse
    {
        return $this->redirectToRoute('app_home');
    }

    #[Route('/{token}', name: 'app_page', requirements: ["token"=> ".+\/$"])]
    public function index(
        string $token,
        ModelRepository $modelRepository,
        ContentRepository $contentRepository,
        SubmodelRepository $submodelRepository
    ): Response
    {
        $page = $contentRepository->findPageByPath(trim($token, '/'));

        /* Pages of type Model */
        if($page->getPageType() == 'model') {
            $submodels = $contentRepository->getSubmodelsByModelId($page->getId());
            /* Works */
            $works = $contentRepository->getWorksByModel($page->getModel()->getId(), 10);
            foreach ($submodels as $submodel) {
                if(!is_null($submodel->getSubmodel())) {
                    $submodel->image = $submodel->getSubmodel()->getImage();
                }
            }
            return $this->render('model/index.html.twig', [
                'controller_name' => 'PageController',
                'models_menu' => $modelRepository->findAllWithPathForMenu(),
                'page' => $contentRepository->findPageByPath(trim($token, '/')),
                'header_nav' => $contentRepository->getHeaderMenu(),
                'footer_nav' => $contentRepository->getFooterMenu(),
                'submodels' => $submodels,
                'works' => $works,
            ]);
        } elseif ($page->getPageType() == 'submodel') {
            $works = $contentRepository->getWorksByModel($page->getSubmodel()->getModelId()->getId(), 10);
            $model_services = $contentRepository->getModelServices($page->getParentId()->getId());
            return $this->render('submodel/index.html.twig', [
                'controller_name' => 'PageController',
                'services' => $contentRepository->getSubmodelServices(),
                'models_menu' => $modelRepository->findAllWithPathForMenu(),
                'page' => $contentRepository->findPageByPath(trim($token, '/')),
                'header_nav' => $contentRepository->getHeaderMenu(),
                'footer_nav' => $contentRepository->getFooterMenu(),
                'works' => $works,
                'model_services' => $model_services,
            ]);
        } else {
            $works = $contentRepository->getAllWorks(10);
            return $this->render('page/index.html.twig', [
                'controller_name' => 'PageController',
                'models_menu' => $modelRepository->findAllWithPathForMenu(),
                'page' => $contentRepository->findPageByPath(trim($token, '/')),
                'header_nav' => $contentRepository->getHeaderMenu(),
                'footer_nav' => $contentRepository->getFooterMenu(),
                'works' => $works,
            ]);
        }

    }
}
