<?php

//src/p6/CoreBundle/controller/IndexController.

namespace p6\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class IndexController extends Controller
{
    public function indexAction()
    {
        $content = $this->get('templating')->render('p6CoreBundle:Index:index.html.twig');

        return new Response($content);
    }
}
