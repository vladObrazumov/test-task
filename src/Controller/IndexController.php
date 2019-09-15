<?php

namespace App\Controller;

use App\Entity\Catalog;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /**
     * @Route("/index", name="index")
     */
    public function index()
    {
        $em = $this->getDoctrine()->getManager();
        $catalogRepository = $em->getRepository(Catalog::class);
        $catalogs = $catalogRepository->getCatalogsTreeWithDocuments();

        return $this->render('index/index.html.twig', [
            'catalogs' => $catalogs,
        ]);
    }
}
