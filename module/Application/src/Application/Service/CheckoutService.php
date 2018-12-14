<?php

namespace Application\Service;

use Application\Entity\Cart;
use Application\Entity\Event;
use Application\Entity\Order;
use Application\Entity\Ticket;
use Application\Repository\CartRepository;
use Application\Repository\TicketRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\DBAL\LockMode;
use Doctrine\ORM\OptimisticLockException;

class CheckoutService
{
    /**
     * @var TicketRepository
     */
    private $ticketRepository;

    /**
     * @var CartRepository
     */
    private $cartRepository;

    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * @var Ticket
     */
    private $ticket;

    /**
     * @var Cart
     */
    private $cart;

    /**
     * @var Event
     */
    private $event;

    /**
     * @var Order
     */
    private $order;

    public function __construct(EntityManager $entityManager)
    {
        $this->ticket = "Application\\Entity\\Ticket";
        $this->cart = "Application\\Entity\\Cart";
        $this->event = "Application\\Entity\\Event";
        $this->order = "Application\\Entity\\Order";

        $this->ticketRepository = $entityManager->getRepository($this->ticket);
        $this->cartRepository = $entityManager->getRepository($this->cart);
        $this->entityManager = $entityManager;
    }

    /**
     * @desc Metodo responsavel pela logica de adicionar os dados no carrinho
     * @param $data
     * @return array
     * @throws \Exception
     */
    public function addToCart($data)
    {
        $date = new \DateTime("now");
        $date->modify("+15 minutes");

        $this->entityManager->getConnection()->beginTransaction();
        $exceptionEntity = null;

        try {

            $this->ticket = $this->ticketRepository->find($data['ticket_id'], LockMode::OPTIMISTIC, $data['v']);

            //validando as quantidades para evitar alguma falha na validacao do front
            if ($this->ticket->getTicketQuantity() < $data['quantitySelected']) {
                throw new \Exception("A quantidade de entradas não pode ser maior do que a quantidade disponível.");
            }

            $this->ticket->setTicketQuantity(intval($this->ticket->getTicketQuantity() - $data['quantitySelected']));

            sleep(5);

            //atualizando o ticket
            $this->entityManager->persist($this->ticket);

            //criando o registro do carrinho
            $this->cart = new Cart([
                'ticket' => $this->ticket,
                'cart_data' => json_encode($data),
                'cart_expires_at' => $date
            ]);

            $this->entityManager->persist($this->cart);

            $this->entityManager->flush();
            $this->entityManager->getConnection()->commit();

        } catch (OptimisticLockException $e) {
            $this->entityManager->getConnection()->rollBack();
            throw new \Exception("infelizmente alguémm acabou de concluir a reserva desse ingresso.");
        } catch (\Exception $e) {
            $this->entityManager->getConnection()->rollBack();
            throw $e;
        }

        return $this->cart->toArray();
    }


    /**
     * @desc Metodo responsavel por buscar as informacoes do evento
     * @param $eventId
     * @param null $ticketId
     * @return array
     */
    public function getEventFullInformation($eventId, $ticketId = null)
    {
        $data = [];
        $data['event'] = $this->entityManager->getReference($this->event, $eventId);

        if ($ticketId) {
            $data['ticket'] = $this->entityManager->getReference($this->ticket, $ticketId);
        }

        return $data;
    }

    /**
     * @desc Metodo responsavel por devolver as entradas para o evento
     * @param $cartId
     * @throws \Exception
     */
    public function clearCart($cartId)
    {
        $this->cart = $this->entityManager->getReference($this->cart, $cartId);
        $cartData = json_decode($this->cart->getCartData(), true);

        $this->entityManager->getConnection()->beginTransaction();

        try {

            //inativando o carrinho
            $this->cart->setCartStatus(0);
            $this->entityManager->persist($this->cart);

            //devolvendo as entradas para o ticket
            $this->ticket = $this->cart->getTicket();
            $this->ticket->setTicketQuantity($this->ticket->getTicketQuantity() + $cartData['quantitySelected']);
            $this->entityManager->persist($this->ticket);

            $this->entityManager->flush();
            $this->entityManager->getConnection()->commit();

        } catch (\Exception $e) {
            $this->entityManager->getConnection()->rollBack();
            throw $e;
        }
    }

    /**
     * @desc Metodo que salva a order na base de dados
     * @param $data
     * @return Order|string
     * @throws \Exception
     */
    public function storeOrder($data)
    {
        $this->cart = $this->entityManager->getReference($this->cart, $data['cart']);

        $this->entityManager->getConnection()->beginTransaction();

        try {

            //atualizando os dados do carrinho
            $this->cart->setCartStatus(2);
            $this->entityManager->persist($this->cart);

            //criando a order
            $this->order = new Order([
                'cart' => $this->cart,
                'order_client_name' => $data['name'],
                'order_client_email' => $data['email'],
                'order_total_amount' => $data['amount']
            ]);

            $this->entityManager->persist($this->order);

            $this->entityManager->flush();
            $this->entityManager->getConnection()->commit();

        } catch (\Exception $e) {
            $this->entityManager->getConnection()->rollBack();
            throw $e;
        }

        return $this->order;
    }
}