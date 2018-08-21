<?php
// src/AppBundle/Controller/RegistrationController.php
namespace p6\UserBundle\Controller;

use p6\UserBundle\Form\UserType;
use p6\UserBundle\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;

class RegistrationController extends Controller
{
    /**
    * @Route("/register", name="register")
    */
    public function registerAction(Request $request, UserPasswordEncoderInterface $passwordEncoder, \Swift_Mailer $mailer)
    {
        // 1) build the form
        $user = new User();
        $form = $this->createForm(UserType::class, $user);

        // 2) handle the submit (will only happen on POST)
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            // 3) Encode the password
            $password = $passwordEncoder->encodePassword($user, $user->getPassword());
            $user->setPassword($password);
            // 3b) Set default avatar
            $idAvatar = 1;
            $user->setIdAvatar($idAvatar);
            //3c) create token
            $token = md5(random_bytes(10));
            $user->setToken($token);
            //3d) set validated = 0
            $isActive = 0;
            $user->setIsActive($isActive);

            //4) switmailer

            $message = \Swift_Message::newInstance()
            ->setSubject('SnowTricks Confirmation de création de compte')
            ->setFrom('noreply@snowtricks.com')
            ->setTo('jb.queralt@gmail.com')
            ->setBody(
                $this->renderView(
                    'Emails/registration.html.twig',
                    array(  'name' => $user->getUsername(),
                    'token' => $user->getToken())
                ),
                'text/html'
                )
                ;

            $this->get('mailer')->send($message);

            // 5) save the User!
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('homepage');
            }

            return $this->render(
                'p6UserBundle:Security:register.html.twig',
                array('form' => $form->createView())
            );
        }

        /**
        * @Route("/validate/token={token}", name="register_validation")
        */
        public function validateAction($token)
        {

            $repository = $this->getDoctrine()->getRepository(User::class);
            $tokendb = $repository->findOneBy(['token' => $token]);

            if (!$tokendb) {
                $this->addFlash(
                    'danger',
                    'Token utilisé non valide'
                );
                return $this->redirectToRoute('register');
            } else {
                $entityManager = $this->getDoctrine()->getManager();
                $user = $entityManager->getRepository(User::class)->findOneBy(['token' => $token]);
                $user->setIsActive('1');
                $user->setToken('');
                $entityManager->flush();


                $this->addFlash(
                    'success',
                    'Votre compte est activé'
                );
                return $this->redirectToRoute('login');
            }
        }
    }
