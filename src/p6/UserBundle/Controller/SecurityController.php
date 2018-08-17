<?php

namespace p6\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;
use p6\UserBundle\Entity\User;


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
    public function forgetAction()
    {
        return $this->render('p6UserBundle:Security:forget.html.twig');
    }

    /**
     * @Route("/reset_password", name="reset")
     */
    public function resetAction()
    {
        return $this->render('p6UserBundle:Security:reset.html.twig');
    }
}
