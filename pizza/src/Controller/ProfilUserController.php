<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use App\Entity\User;

class ProfilUserController extends AbstractController
{
    
//  @Security("has_role('ROLE_USER')")
    /**
     * @Route("/profiluser", name="profil_user")
     * 
     */
    public function index(): Response
    {
        return $this->render('profil_user.html.twig', [
            'controller_name' => 'ProfilUserController',
        ]);
    }  
}

