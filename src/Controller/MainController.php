<?php

namespace App\Controller;

use App\Short\UrlEncoder;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/main', name: 'app_main')]
    public function index(): Response
    {
        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }

    #[Route('/encode/{url}', name: 'URL encode', requirements: ['url' => '.+'])]
    public function test(string $url, UrlEncoder $urlEncoder): Response
    {
        $code = $urlEncoder->encode($url);
        return new Response($code);
//        return $this->render('main/index.html.twig', [
//            'controller_name' => 'MainController',
//        ]);
    }

}
