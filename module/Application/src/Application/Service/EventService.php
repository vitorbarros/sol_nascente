<?php

namespace Application\Service;

use Application\Repository\EventRepository;
use Doctrine\ORM\EntityManager;

class EventService
{
    /**
     * @var EventRepository
     */
    private $eventRepository;

    public function __construct(EntityManager $entityManager)
    {
        $this->eventRepository = $entityManager->getRepository("Application\\Entity\\Event");
    }

    public function getEvents()
    {
        return $this->eventRepository->findByEventStatus(1);
    }
}