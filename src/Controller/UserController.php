<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use App\Form\RegisterType;
Use App\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserController extends AbstractController
{
    /**
     * @Route("/login", name="login")
     */
    public function index( AuthenticationUtils $authenticationUtils )
    {
        return $this->render('user/login.html.twig', [
            'lastUsername' => $authenticationUtils->getLastUsername()
        ]);
    }

    /**
     * @Route("/logout", name="logout")
     */
     public function logout(){}

     /**
     * @Route("/register", name="register")
     */
      public function register(Request $request, UserPasswordEncoderInterface $encoder){

          $user = new User();
          $form = $this->createForm(RegisterType::class, $user);
          $form->handleRequest($request);
          if($form->isSubmitted() && $form->isValid()) {
              $user->setRoles ( [
                  'ROLE_USER'
              ]);
              $encoded = $encoder->encodePassword($user, $user->getPlainPassword());
              $user->setPassword($encoded);
              $em = $this->getDoctrine()->getManager();
              $em->persist($user);
              $em->flush();

              return $this->redirectToRoute('login');

          }


        return $this->render('user/register.html.twig', [
            'form' => $form->createView()
            ]);
      }


}
