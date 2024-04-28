<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\Type\SignupType;
use App\Service\RegisterService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    private $em;

    public function __construct(
        private readonly RegisterService $registerService,
        EntityManagerInterface $em
    ) {
        $this->em = $em;
    }

    #[Route('/login', name: 'security_login', methods: ['GET', 'POST'])]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        return $this->render('security/login.html.twig', [
            'error' => $authenticationUtils->getLastAuthenticationError(),
            'last_username' => $authenticationUtils->getLastUsername(),
        ]);
    }

    #[Route('/signup', name: 'security_signup', methods: ['GET', 'POST'])]
    public function signup(Request $request): Response
    {
        $form = $this->createForm(SignupType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $formData = $form->getData();
            
           

            if ($this->usernameExists($formData->getUsername())) {
                $this->addFlash('error', 'Le nom d\'utilisateur existe déjà.');
                return $this->redirectToRoute('security_signup'); // Redirection vers le formulaire
            }

            $this->registerService->register($formData);
            return $this->redirectToRoute('security_login');
        }

        return $this->render('security/signup.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    private function usernameExists($username)
    {
        // Recherche de l'utilisateur par son nom d'utilisateur dans la base de données
        $user = $this->em->getRepository(User::class)->findOneBy(['username' => $username]);

        return $user !== null; // Retourne vrai si l'utilisateur existe, sinon faux
    }
}
