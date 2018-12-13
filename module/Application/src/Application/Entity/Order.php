<?php

namespace Application\Entity;

use Zend\Stdlib\Hydrator;
use Doctrine\ORM\Mapping as ORM;

/**
 * Order
 *
 * @ORM\Table(name="orders")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="Application\Repository\OrderRepository")
 */
class Order
{
    /**
     * @var integer
     *
     * @ORM\Column(name="order_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $orderId;

    /**
     * @var string
     *
     * @ORM\Column(name="order_client_name", type="string", length=255, nullable=false)
     */
    private $orderClientName;

    /**
     * @var string
     *
     * @ORM\Column(name="order_client_email", type="string", length=255, nullable=false)
     */
    private $orderClientEmail;

    /**
     * @var Cart
     *
     * @ORM\ManyToOne(targetEntity="Cart")
     * @ORM\JoinColumn(name="cart", referencedColumnName="cart_id")
     */
    private $cart;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="order_created_at", type="datetime", nullable=false)
     */
    private $orderCreatedAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="order_updated_at", type="datetime", nullable=false)
     */
    private $orderUpdatedAt;

    /**
     * @var integer
     *
     * @ORM\Column(name="order_total_amount", type="integer", nullable=false)
     */
    private $orderTotalAmount;

    public function __construct(array $options = [])
    {
        (new Hydrator\ClassMethods())->hydrate($options, $this);
        $this->orderCreatedAt = new \DateTime("now");
        $this->orderUpdatedAt = new \DateTime("now");
    }

    /**
     * @return int
     */
    public function getOrderId()
    {
        return $this->orderId;
    }

    /**
     * @param int $orderId
     * @return Order
     */
    public function setOrderId($orderId)
    {
        $this->orderId = $orderId;
        return $this;
    }

    /**
     * @return string
     */
    public function getOrderClientName()
    {
        return $this->orderClientName;
    }

    /**
     * @param string $orderClientName
     * @return Order
     */
    public function setOrderClientName($orderClientName)
    {
        $this->orderClientName = $orderClientName;
        return $this;
    }

    /**
     * @return string
     */
    public function getOrderClientEmail()
    {
        return $this->orderClientEmail;
    }

    /**
     * @param string $orderClientEmail
     * @return Order
     */
    public function setOrderClientEmail($orderClientEmail)
    {
        $this->orderClientEmail = $orderClientEmail;
        return $this;
    }

    /**
     * @return Cart
     */
    public function getCart()
    {
        return $this->cart;
    }

    /**
     * @param Cart $cart
     * @return Order
     */
    public function setCart($cart)
    {
        $this->cart = $cart;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getOrderCreatedAt()
    {
        return $this->orderCreatedAt;
    }

    /**
     * @param \DateTime $orderCreatedAt
     * @return Order
     */
    public function setOrderCreatedAt($orderCreatedAt)
    {
        $this->orderCreatedAt = $orderCreatedAt;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getOrderUpdatedAt()
    {
        return $this->orderUpdatedAt;
    }

    /**
     * @ORM\PreUpdate
     */
    public function setOrderUpdatedAt()
    {
        $this->orderUpdatedAt = new \DateTime("now");
        return $this;
    }

    /**
     * @return int
     */
    public function getOrderTotalAmount()
    {
        return $this->orderTotalAmount;
    }

    /**
     * @param int $orderTotalAmount
     * @return Order
     */
    public function setOrderTotalAmount($orderTotalAmount)
    {
        $this->orderTotalAmount = $orderTotalAmount;
        return $this;
    }
}