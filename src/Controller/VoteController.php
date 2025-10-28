<?php

namespace App\Controller;

use App\Entity\Vote;
use App\Form\VoteType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class VoteController extends AbstractController
{
    #[Route('/vote', name: 'vote')]
    public function index(): Response
    {
        return $this->render('vote/index.html.twig', [
            'controller_name' => 'VoteController',
        ]);
    }

    #[Route('/admin/vote/create', name:'vote.create')]
    public function create(Request $request, EntityManagerInterface $em): Response {
        $vote = new Vote();
        $voteForm = $this->createForm(VoteType::class, $vote);
        $voteForm->handleRequest($request);

        if($voteForm->isSubmitted() && $voteForm->isValid()) {
            $em->persist($vote);
            $em->flush();

            return $this->redirectToRoute('home');
        }

        return $this->render('vote/create.html.twig', [
            
        ]);
    }

    
}
