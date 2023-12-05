<?php

namespace App\Controller;

use App\Repository\ContentRepository;
use App\Repository\ModelRepository;
use App\Repository\SubmodelRepository;
use App\Repository\VideoGalleryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Finder\Finder;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(
        ModelRepository $modelRepository,
        ContentRepository $contentRepository,
        VideoGalleryRepository $videoGalleryRepository,
        SubmodelRepository $submodelRepository
    ): Response
    {
        $finder = new Finder();
        /* Photo gallery */
        $finder->files()->in("images/home/gallery");
        $gallery = [];
        if($finder->hasResults()) {
            foreach ($finder as $file) {
                $gallery[] = "images/home/gallery/".$file->getRelativePathname();
            }
        }

        /* Video gallery */
        $videos = $videoGalleryRepository->findBy(['active' => 1], null, 3);

        /* Works */
        $works  = $contentRepository->findBy(['parent_id' => 62, 'published' => 1], ['created_at' => 'DESC'], 10);

        /* Models - Submodels  */
        $models_array = $modelRepository->findAllWithPath();
        foreach ($models_array as $key => $item) {
            $models_array[$key]['children'] = $submodelRepository->findWithPathByBrand($item[0]->getId());
        }

        /* Services */
        $services = $contentRepository->findBy(['parent_id' => 59, 'published' => 1], ['id' => 'ASC']);

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            /*'models_menu' => $modelRepository->findBy(['status' => 1, 'show_in_menu' => 1], ['menu_order' => 'ASC']),*/
            'models_menu' => $modelRepository->findAllWithPathForMenu(),
            'header_nav' => $contentRepository->getHeaderMenu(),
            'footer_nav' => $contentRepository->getFooterMenu(),
            'page' => $contentRepository->findPageByPath('index'),
            'gallery' => $gallery,
            'video_gallery' => $videos,
            'works' => $works,
            'models_array' => $models_array,
            'services' => $services,
        ]);
    }
}
