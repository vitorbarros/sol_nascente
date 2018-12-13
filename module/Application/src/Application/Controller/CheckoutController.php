<?php

namespace Application\Controller;

use Application\Service\CheckoutService;
use Doctrine\ORM\EntityManager;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\JsonModel;
use Zend\View\Model\ViewModel;

class CheckoutController extends AbstractActionController
{
    /**
     * @var CheckoutService
     */
    private $checkoutService;

    public function __construct(EntityManager $entityManager)
    {
        $this->checkoutService = new CheckoutService($entityManager);
    }

    /**
     * @desc Metodo que recebe o request do ajax
     * @return JsonModel
     */
    public function addToCartAction()
    {
        $request = $this->getRequest();
        $response = $this->getResponse();

        if ($request->isPost()) {

            $data = $request->getPost()->toArray();

            try {

                //enviado para o servico executar as devidas operacoes
                $cart = $this->checkoutService->addToCart($data);

                return new JsonModel([
                    'success' => true,
                    'data' => $cart
                ]);

            } catch (\Exception $e) {
                $response->setStatusCode(400);
                return new JsonModel([
                    'success' => false,
                    'message' => $e->getMessage()
                ]);
            }
        }
    }

    /**
     * @desc Metodo que renderiza a pagina de copmpra
     * @return ViewModel
     */
    public function indexAction()
    {
        if (isset($_COOKIE['cart'])) {

            $cart = json_decode($_COOKIE['cart'], true);
            $cartData = json_decode($cart['cart_data'], true);

            $data = $this->checkoutService->getEventFullInformation($cartData['event_id'], $cartData['ticket_id']);
            $data['cart'] = $cart;
            $data['cartData'] = $cartData;

            return new ViewModel($data);
        }

        return new ViewModel();
    }

    /**
     * @desc Metodo que faz as chamadas para limpar o carrinho e devolver as entradas
     * @return JsonModel
     */
    public function removeFromCartAction()
    {
        $id = $this->params()->fromRoute('id');

        $this->checkoutService->clearCart($id);
        return new JsonModel([true]);
    }

    /**
     * @desc Metodo que finaliza o pedido
     * @return JsonModel
     */
    public function orderAction()
    {
        $request = $this->getRequest();
        $response = $this->getResponse();

        if ($request->isPost()) {

            $data = $request->getPost()->toArray();

            //verificando os campos vazios
            $empty = [];
            foreach ($data as $k => $v) {
                if ($v == null) {
                    $empty[] = $k;
                }
            }

            if (!empty($empty)) {
                $response->setStatusCode(422);
                return new JsonModel([
                    'success' => false,
                    'message' => "Preencha os campos obrigatórios",
                    'fields' => $empty
                ]);
            }

            try {

                $this->checkoutService->storeOrder($data);

                return new JsonModel([
                    'success' => true
                ]);

            } catch (\Exception $e) {
                $response->setStatusCode(400);
                return new JsonModel([
                    'success' => false,
                    'message' => $e->getMessage()
                ]);
            }
        }
    }
}