<?php

namespace App\Controller;
use App\Entity\User;
use App\Form\RegistrationFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class RegistrationController extends AbstractController
{
    /**
     * @Route("/registration", name="registration")
     */
    public function registration(Request $request, EntityManagerInterface $manager, UserPasswordHasherInterface $passwordHasher)
    {
    $user = new User();

    $form = $this->createForm(RegistrationFormType::class, $user);

    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {

        $hashedPassword = $passwordHasher->hashPassword($user, $user->getpassword());
        $user->setpassword($hashedPassword);

        $manager->persist($user);
        $manager->flush();

        return $this->redirectToRoute('app_login');
    }


    return $this->render('registration/index.html.twig', [
        'form' => $form->createView()
    ]);
}

}
