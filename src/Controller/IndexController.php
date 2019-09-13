<?php

namespace App\Controller;

use App\Entity\Catalog;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /**
     * @Route("/index", name="index")
     */
    public function index()
    {
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository(Catalog::class);
        $htmlTree = $repo->childrenHierarchy(
            null,
            false,
            array(
                'decorate' => true,
                'representationField' => 'slug',
                'html' => true
            )
        );
        return new Response($htmlTree);
    }
}
