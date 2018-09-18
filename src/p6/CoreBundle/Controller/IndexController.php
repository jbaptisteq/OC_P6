<?php

//src/p6/CoreBundle/controller/IndexController.php

namespace p6\CoreBundle\Controller;


use p6\CoreBundle\Entity\Trick;
use p6\UserBundle\Entity\Comment;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Core\Security;

class IndexController extends Controller
{
  /**
  * @Route("/", name="homepage")
  */
  public function indexAction()
  {
    $repository = $this->getDoctrine()->getManager()->getRepository('p6CoreBundle:Trick');

    if (!isset($_SESSION['nbtricks'])) {
      $_SESSION['nbtricks'] = 5;
      $tricklist = $repository->findBy(
        array('published' => '1' ),
        array('creaDate' => 'ASC'),
        $_SESSION['nbtricks'],
        0
      );} else {
        $tricklist = $repository->findBy(
          array('published' => '1' ),
          array('creaDate' => 'ASC'),
          $_SESSION['nbtricks'],
          0
        );
      }

      return $this->render('p6CoreBundle:Index:index.html.twig', array('tricklist' => $tricklist));
    }

    /**
    * @Route("/showMore", name="showMore")
    */
    public function showMoreAction()
    {
      $_SESSION['nbtricks'] = $_SESSION['nbtricks'] + 5;

      return $this->redirectToRoute('homepage');
    }

    /**
    * @Route("/trick/detail/{id}", name="trick")
    */
    public function viewAction(Request $request, $id)
    {
      $entityManager = $this->getDoctrine()->getManager();
      $trick = $entityManager->getRepository('p6CoreBundle:Trick')->find($id);

      if (!isset($_SESSION['nbcomments'])) {
        $_SESSION['nbcomments'] = 5;
        $comments = $entityManager->getRepository('p6UserBundle:Comment')->findBy(
          array('trick' => $trick ),
          array('datetime' => 'DESC'),
          $_SESSION['nbcomments'],
          0
        );} else {
          $comments = $entityManager->getRepository('p6UserBundle:Comment')->findBy(
            array('trick' => $trick ),
            array('datetime' => 'DESC'),
            $_SESSION['nbcomments'],
            0
          );
        }

        if (null === $trick) {
          return $this->redirectToRoute('homepage');
        }

        $trick->getImages();
        $trick->getVideos();

        return $this->render('p6CoreBundle:Index:trick.html.twig', array(
          'trick' => $trick,
          'comments' => $comments
        ));
      }

      /**
      * @Route("/addComment/{id}", name="addComment")
      */
      public function addCommentAction(Request $request, $id)
      {
        if ($request->isMethod('POST')) {

          $submittedToken = $request->request->get('token');
          if ($this->isCsrfTokenValid('post-item', $submittedToken)) {

            $comment = new Comment();

            $user = $this->getUser();
            $comment->setUser($user);

            $trick = $this->getDoctrine()->getManager()->getRepository('p6CoreBundle:Trick')->find($id);
            $comment->setTrick($trick);

            $content = $request->request->get('content');
            $comment->setContent($content);

            $comment->setDatetime(new \DateTime());

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($comment);
            $entityManager->flush();

            return $this->redirectToRoute('trick', array('id' => $id));
          }
        }
        $this->addFlash('alert', 'Erreur lors de l\'envoi du commentaire');

        return $this->redirectToRoute('homepage');
      }
    }
