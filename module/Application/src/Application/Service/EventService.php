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

    /**
     * @var EntityManager
     */
    private $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->eventRepository = $entityManager->getRepository("Application\\Entity\\Event");
        $this->entityManager = $entityManager;
    }

    public function getEvents()
    {
        return $this->eventRepository->findByEventStatus(1);
    }

    public function getEventInCache($id)
    {
        return $this->entityManager->getReference("Application\\Entity\\Event", $id);
    }
}