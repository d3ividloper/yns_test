<?php

namespace App\Api\Controller;

use App\Api\Contracts\AbstractApiController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class MainApiController extends AbstractApiController
{
    /**
     * @Route("/", name="index", methods={"GET"})
     */
    public function index(): Response
    {
        return $this->redirectToRoute('backoffice_review_list');
    }

}
