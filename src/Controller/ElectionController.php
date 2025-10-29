<?php

namespace App\Controller;

use App\Entity\Election;
use App\Form\ElectionType;
use App\Message\ElectionMessage;
use App\Repository\VoteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
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

    #[Route('/election/create/{id}', name:'election.create')]
    public function create(int $id, Request $request, MessageBusInterface $bus): Response {
        $election = new Election();
        $electionForm = $this->createForm(ElectionType::class, $election);

        $electionForm->handleRequest($request);
        if($electionForm->isSubmitted() && $electionForm->isValid()) {
            $title = $electionForm->get('title')->getData();

            $bus->dispatch(new ElectionMessage(
                $title,
                $id
            ));

            return $this->redirectToRoute('home');

        }

        return $this->render('election/create.html.twig', [
            'electionForm' => $electionForm->createView()
        ]);
    }
}
