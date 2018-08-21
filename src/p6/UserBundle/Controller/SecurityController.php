<?php

namespace p6\UserBundle\Controller;

use p6\UserBundle\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;

class SecurityController extends Controller
{
  /**
  * @Route("/login", name="login")
  */
  public function loginAction()
  {
    if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_REMEMBERED')){
      return $this->redirectToRoute('homepage');
    }

    $authenticationUtils = $this->get('security.authentication_utils');

    return $this->render('p6UserBundle:Security:login.html.twig', array(
      'last_username' => $authenticationUtils->getLastUsername(),
      'error'         => $authenticationUtils->getLastAuthenticationError(),
    ));
  }

  /**
  * @Route("/forgot_password", name="forget")
  */
  public function forgetAction(Request $request, \Swift_Mailer $mailer)
  {
    if ($request->isMethod('post')) {
      $entityManager = $this->getDoctrine()->getManager();
      $user = $entityManager->getRepository(User::class)->FindOneBy(['username' => $request->request->get('username')]);
      $user->setToken(md5(random_bytes(10)));

      $message = \Swift_Message::newInstance()
        ->setSubject('SnowTricks Changement de mot de passe')
        ->setFrom('noreply@snowtricks.com')
        ->setTo('jb.queralt@gmail.com')
        ->setBody($this->renderView('Emails/recup.html.twig', array('name' => $user->getUsername(), 'token' => $user->getToken())), 'text/html');
      $this->get('mailer')->send($message);
      $this->addFlash('sendReset', 'Email de reset envoyé');
      $entityManager->persist($user);
      $entityManager->flush();

      return $this->RedirectToRoute('forget');
    }

    return $this->render('p6UserBundle:Security:forget.html.twig');
  }

    /**
    * @Route("/reset_password/token={token}", name="reset")
    */
    public function resetAction(Request $request, UserPasswordEncoderInterface $passwordEncoder, $token)
    {
      if ($request->isMethod('post')) {
        $repository = $this->getDoctrine()->getRepository(User::class);

        if (!$repository->findOneBy(['token' => $token])) {
          $this->addFlash('danger', 'Token utilisé non valide');

          return $this->redirectToRoute('login');
        } else if (!$repository->findOneBy(['email' => $request->request->get('emailCheck')])) {
          $this->addFlash('danger', 'Email utilisé non valide');

          return $this->redirectToRoute('login');
      } else if (empty($request->request->get('newPassword'))) {
          $this->addFlash('danger', 'Veuillez saisir un mot de passe');

          return $this->redirectToRoute('login');
        } else {
          $entityManager = $this->getDoctrine()->getManager();
          $user = $entityManager->getRepository(User::class)->FindOneBy(['token' => $token]);
          $password = $passwordEncoder->encodePassword($user, $request->request->get('newPassword'));
          $user->setPassword($password);
          $user->setToken('');
          $entityManager->flush();
          $this->addFlash('success', 'Mot de passe changé');

          return $this->redirectToRoute('login');
        }
      }

      return $this->render('p6UserBundle:Security:reset.html.twig');
    }
  }
