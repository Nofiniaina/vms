<?php

namespace App\MessageHandler;

use App\Entity\Election;
use App\Entity\Vote;
use App\Message\ElectionMessage;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final class ElectionMessageHandler
{
    public function __construct(
        private EntityManagerInterface $em
    ) {
    }

    public function __invoke(ElectionMessage $message): void
    {
        
        $election = new Election();
        $election->setTitle($message->title);
        $vote = $this->em->getRepository(Vote::class)->find($message->vote);
        $election->setVote($vote);

        $this->em->persist($election);
        $this->em->flush();
    }
}
