<?php

namespace Application\Controller;

use Application\Service\EventService;
use Doctrine\ORM\EntityManager;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    /**
     * @var EventService
     */
    private $eventService;

    public function __construct(EntityManager $entityManager)
    {
        $this->eventService = new EventService($entityManager);
    }

    public function indexAction()
    {
        return new ViewModel([
            'events' => $this->eventService->getEvents()
        ]);
    }

    public function detailAction()
    {

    }
}
