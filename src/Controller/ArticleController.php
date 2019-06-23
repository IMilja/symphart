<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @Route("/article", name="article.")
 */
class ArticleController extends Controller{
    /**
     *  @Route("/", name="index");
     *  @Method({"GET"})
     */
    public function index(){
        // return new Response("<html><body>Hello</body></html>");
        return $this->render('articles/index.html.twig');
    }
}