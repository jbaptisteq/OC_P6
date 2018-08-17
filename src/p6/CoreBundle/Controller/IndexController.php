<?php

//src/p6/CoreBundle/controller/IndexController.php

namespace p6\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        $repository = $this->getDoctrine()
            ->getManager()
            ->getRepository('p6CoreBundle:Trick')
        ;

        $tricklist = $repository->findall();

        return $this->render('p6CoreBundle:Index:index.html.twig', array(
            'tricklist' => $tricklist
        ));
    }
}
