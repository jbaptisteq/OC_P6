<?php
// src/p6/CoreBundle/Controller/TrickController.php
namespace p6\CoreBundle\Controller;

use p6\CoreBundle\Entity\Trick;
use p6\CoreBundle\Entity\Category;
use p6\CoreBundle\Entity\Image;
use p6\CoreBundle\Entity\Video;
use p6\CoreBundle\Form\TrickType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Validator\Constraints\DateTime;

class TrickController extends Controller
{
  /**
  * @Route("/newTrick", name="newTrick")
  */
  public function addAction(Request $request)
  {
    // 1) build the form
    $trick = new Trick();
    $form = $this->createForm(TrickType::class, $trick);

   // 2) handle the submit (will only happen on POST)
    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {

      $trick->setPublished(1);
      $entityManager = $this->getDoctrine()->getManager();
      $entityManager->persist($trick);
      $entityManager->flush();

      $this->addFlash('success', 'Trick Ajouté.');

      return $this->redirectToRoute('homepage');
    }

    return $this->render('p6CoreBundle:Trick:add.html.twig', array('form' => $form->createView(),));
  }

  /**
  * @Route("/editTrick/{id}", name="editTrick")
  */
  public function editAction(Request $request, $id)
  {
    $entityManager = $this->getDoctrine()->getManager();
    $trick = $entityManager->getRepository('p6CoreBundle:Trick')->find($id);
    $form = $this->createForm(TrickType::class, $trick);

    if (null === $trick) {
      return $this->redirectToRoute('homepage');
    }

    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {

      $trick->SetEditDate(new \DateTime());

      $entityManager = $this->getDoctrine()->getManager();
      $entityManager->persist($trick);
      $entityManager->flush();

      $this->addFlash('success', 'Trick Modifié.');

      return $this->redirectToRoute('homepage');
    }

    $form = $this->get('form.factory')->create(TrickType::class, $trick);

    return $this->render('p6CoreBundle:Trick:edit.html.twig', array(
      'trick' => $trick,
      'form' => $form->createView(),
    ));
  }

  /**
  * @Route("/deleteTrick/{id}", name="deleteTrick")
  */
  public function deleteAction(Request $request, $id)
  {
    $entityManager = $this->getDoctrine()->getManager();
    $trick = $entityManager->getRepository('p6CoreBundle:Trick')->find($id);
    $form = $this->get('form.factory')->create();

    if (null === $trick) {
      return $this->redirectToRoute('homepage');
    }

    if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {

      $submittedToken = $request->request->get('token');

      // 'delete-item' is the same value used in the template to generate the token
      if ($this->isCsrfTokenValid('delete-item', $submittedToken)) {

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($trick);
        $entityManager->flush();

        $this->addFlash('success', 'Trick Supprimé.');

        return $this->redirectToRoute('homepage');
      }

      $this->addFlash('alert', 'Erreur lors de la suppréssion du Trick');

      return $this->redirectToRoute('homepage');
    }

    return $this->render('p6CoreBundle:Trick:delete.html.twig', array(
      'trick' => $trick,
      'form'   => $form->createView(),
    ));
  }

  /**
  * @Route("/deleteImage/{idtrick}/{id}", name="deleteImage")
  */
  public function deleteImageAction(Request $request, $idtrick, $id)
  {

    if ($request->isMethod('POST')) {

      $submittedToken = $request->request->get('token');
      if ($this->isCsrfTokenValid('delete-item', $submittedToken)) {

        $entityManager = $this->getDoctrine()->getManager();
        $image = $entityManager->getRepository('p6CoreBundle:Image')->find($id);
        $entityManager->remove($image);
        $entityManager->flush();

        $this->addFlash('success', 'Image Supprimée.');

        return $this->redirectToRoute('trick', array('id' => $idtrick));
      }
    }
    $this->addFlash('alert', 'Erreur lors de la suppréssion de l\'image .');

    return $this->redirectToRoute('homepage');
  }

  /**
  * @Route("/deleteVideo/{idtrick}/{id}", name="deleteVideo")
  */
  public function deleteVideoAction(Request $request, $idtrick, $id)
  {

    if ($request->isMethod('POST')) {

      $submittedToken = $request->request->get('token');
      if ($this->isCsrfTokenValid('delete-item', $submittedToken)) {

        $entityManager = $this->getDoctrine()->getManager();
        $video = $entityManager->getRepository('p6CoreBundle:Video')->find($id);
        $entityManager->remove($video);
        $entityManager->flush();

        $this->addFlash('success', 'Vidéo Supprimée.');

        return $this->redirectToRoute('trick', array('id' => $idtrick));
      }
    }
    $this->addFlash('alert', 'Erreur lors de la suppréssion de la vidéo');

    return $this->redirectToRoute('homepage');
  }

  /**
  * @Route("/updateImage/{id}", name="updateImage")
  */
  public function updateImageAction(Request $request, $idtrick, $id)
  {

    if ($request->isMethod('POST')) {

      $submittedToken = $request->request->get('token');
      if ($this->isCsrfTokenValid('update-item', $submittedToken)) {

        $entityManager = $this->getDoctrine()->getManager();
        $image = $entityManager->getRepository('p6CoreBundle:Image')->find($id);

        $newImage = $request->request->get('newImage');
        $image->setUrl($newImage);
        $entityManager->flush();

        $this->addFlash('success', 'Image Editée.');

        return $this->redirectToRoute('trick', array('id' => $idtrick));
      }
    }
    $this->addFlash('alert', 'Erreur lors de l\'édition de l\'image.');

    return $this->redirectToRoute('homepage');
  }

  /**
  * @Route("/updateVideo/{id}", name="updateVideo")
  */
  public function updateVideoAction(Request $request, $idtrick, $id)
  {

    if ($request->isMethod('POST')) {

      $submittedToken = $request->request->get('token');
      if ($this->isCsrfTokenValid('update-item', $submittedToken)) {

        $entityManager = $this->getDoctrine()->getManager();
        $video = $entityManager->getRepository('p6CoreBundle:Video')->find($id);

        $newLink = $request->request->get('newLink');
        $video->setLink($newLink);

        $entityManager->flush();

        $this->addFlash('success', 'Vidéo Modifiée');

        return $this->redirectToRoute('trick', array('id' => $idtrick));
      }
    }
    $this->addFlash('alert', 'Erreur lors de la modification de la vidéo');

    return $this->redirectToRoute('homepage');
  }

  /**
  * @Route("/showMoreComment/{id}", name="showMoreComment")
  */
  public function showMoreCommentAction($id)
  {
    $_SESSION['nbcomments'] = $_SESSION['nbcomments'] + 5;

    return $this->redirectToRoute('trick', array('id' => $id));
  }

}
