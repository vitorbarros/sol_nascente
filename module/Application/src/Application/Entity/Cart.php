<?php

namespace Application\Entity;

use Zend\Stdlib\Hydrator;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Version;

/**
 * Cart
 *
 * @ORM\Table(name="carts")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="Application\Repository\CartRepository")
 */
class Cart
{
    /**
     * @var integer
     *
     * @ORM\Column(name="cart_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $cartId;

    /**
     * @var string
     *
     * @ORM\Column(name="cart_data", type="string", length=255, nullable=false)
     */
    private $cartData;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="cart_created_at", type="datetime", nullable=false)
     */
    private $cartCreatedAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="cart_updated_at", type="datetime", nullable=false)
     */
    private $cartUpdatedAt;

    /**
     * @var integer
     *
     * @ORM\Column(name="cart_status", type="integer", nullable=false)
     */
    private $cartStatus;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="cart_expires_at", type="datetime", nullable=false)
     */
    private $cartExpiresAt;

    /**
     * @var Ticket
     *
     * @ORM\ManyToOne(targetEntity="Ticket")
     * @ORM\JoinColumn(name="ticket", referencedColumnName="ticket_id")
     */
    private $ticket;

    /** @ORM\Version @ORM\Column(type="integer") */
    private $version;


    public function __construct(array $options = [])
    {
        (new Hydrator\ClassMethods())->hydrate($options, $this);
        $this->cartCreatedAt = new \DateTime("now");
        $this->cartUpdatedAt = new \DateTime("now");
        $this->cartStatus = 1;
    }

    /**
     * @return int
     */
    public function getCartId()
    {
        return $this->cartId;
    }

    /**
     * @param int $cartId
     * @return Cart
     */
    public function setCartId($cartId)
    {
        $this->cartId = $cartId;
        return $this;
    }

    /**
     * @return string
     */
    public function getCartData()
    {
        return $this->cartData;
    }

    /**
     * @param string $cartData
     * @return Cart
     */
    public function setCartData($cartData)
    {
        $this->cartData = $cartData;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCartCreatedAt()
    {
        return $this->cartCreatedAt;
    }

    /**
     * @param \DateTime $cartCreatedAt
     * @return Cart
     */
    public function setCartCreatedAt($cartCreatedAt)
    {
        $this->cartCreatedAt = $cartCreatedAt;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCartUpdatedAt()
    {
        return $this->cartUpdatedAt;
    }

    /**
     * @ORM\PreUpdate
     */
    public function setCartUpdatedAt()
    {
        $this->cartUpdatedAt = new \DateTime("now");
        return $this;
    }

    /**
     * @return int
     */
    public function getCartStatus()
    {
        return $this->cartStatus;
    }

    /**
     * @param int $cartStatus
     * @return Cart
     */
    public function setCartStatus($cartStatus)
    {
        $this->cartStatus = $cartStatus;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCartExpiresAt()
    {
        return $this->cartExpiresAt;
    }

    /**
     * @param \DateTime $cartExpiresAt
     * @return Cart
     */
    public function setCartExpiresAt($cartExpiresAt)
    {
        $this->cartExpiresAt = $cartExpiresAt;
        return $this;
    }

    /**
     * @return Ticket
     */
    public function getTicket()
    {
        return $this->ticket;
    }

    /**
     * @param Ticket $ticket
     * @return Cart
     */
    public function setTicket($ticket)
    {
        $this->ticket = $ticket;
        return $this;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return (new Hydrator\ClassMethods())->extract($this);
    }

    /**
     * @return mixed
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * @param mixed $version
     * @return Cart
     */
    public function setVersion($version)
    {
        $this->version = $version;
        return $this;
    }
}