<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ElectionController extends AbstractController
{
    #[Route('/election', name: 'election')]
    public function index(): Response
    {
        return $this->render('election/index.html.twig', [
            'controller_name' => 'ElectionController',
        ]);
    }

    #[Route('/election/create', name:'election.create')]
    public function create(Request $request, EntityManagerInterface $em): Response {
        return $this->render('election/create.html.twig', [
            
        ]);
    }
}
