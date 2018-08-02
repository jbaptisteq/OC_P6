<?php

//src/p6/CoreBundle/controller/IndexController.php

namespace p6\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class IndexController extends Controller
{
    public function indexAction()
    {
        $repository = $this->getDoctrine()
            ->getManager()
            ->getRepository('p6CoreBundle:trick')
        ;

        $tricklist = $repository->findall();

        return $this->render('p6CoreBundle:Index:index.html.twig', array(
            'tricklist' => $tricklist
        ));
    }
}
