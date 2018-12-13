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

    /**
     * @desc Home
     * @return ViewModel
     */
    public function indexAction()
    {
        return new ViewModel([
            'events' => $this->eventService->getEvents()
        ]);
    }

    /**
     * @desc Pagina de detalhes do evento
     * @return ViewModel
     */
    public function detailAction()
    {
        //verificando o parametro na url
        $id = $this->params()->fromRoute('id');

        if ($id == null) {
            $this->redirect()->toRoute('home');
        }

        return new ViewModel([
            'event' => $this->eventService->getEventInCache($id)
        ]);
    }

    /**
     * @desc Página de obrigado
     * @return ViewModel
     */
    public function successAction()
    {
        return new ViewModel();
    }
}
