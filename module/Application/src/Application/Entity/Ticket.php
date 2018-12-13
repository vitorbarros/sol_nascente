<?php

namespace Application\Entity;

use Zend\Stdlib\Hydrator;
use Doctrine\ORM\Mapping as ORM;

/**
 * Event
 *
 * @ORM\Table(name="tickets")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="Application\Repository\TicketRepository")
 */
class Ticket
{
    /**
     * @var integer
     *
     * @ORM\Column(name="ticket_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $ticketId;

    /**
     * @var integer
     *
     * @ORM\Column(name="ticket_quantity", type="integer", nullable=false)
     */
    private $ticketQuantity;

    /**
     * @var integer
     *
     * @ORM\Column(name="ticket_initial_quantity", type="integer", nullable=false)
     */
    private $ticketInitialQuantity;

    /**
     * @var string
     *
     * @ORM\Column(name="ticket_lot", type="string", length=255, nullable=false)
     */
    private $ticketLot;

    /**
     * @var integer
     *
     * @ORM\Column(name="ticket_price", type="integer", nullable=false)
     */
    private $ticketPrice;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="ticket_created_at", type="datetime", nullable=false)
     */
    private $ticketCreatedAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="ticket_updated_at", type="datetime", nullable=false)
     */
    private $ticketUpdatedAt;

    /**
     * @var Event
     *
     * @ORM\ManyToOne(targetEntity="Event")
     * @ORM\JoinColumn(name="event", referencedColumnName="event_id")
     */
    private $event;

    /**
     * @var Cart
     *
     * One Category has Many Categories.
     * @ORM\OneToMany(targetEntity="Cart", mappedBy="ticket")
     */
    private $carts;

    public function __construct(array $options = [])
    {
        (new Hydrator\ClassMethods())->hydrate($options, $this);
        $this->ticketCreatedAt = new \DateTime("now");
        $this->ticketUpdatedAt = new \DateTime("now");
    }

    /**
     * @return int
     */
    public function getTicketId()
    {
        return $this->ticketId;
    }

    /**
     * @param int $ticketId
     * @return Ticket
     */
    public function setTicketId($ticketId)
    {
        $this->ticketId = $ticketId;
        return $this;
    }

    /**
     * @return int
     */
    public function getTicketQuantity()
    {
        return $this->ticketQuantity;
    }

    /**
     * @param int $ticketQuantity
     * @return Ticket
     */
    public function setTicketQuantity($ticketQuantity)
    {
        $this->ticketQuantity = $ticketQuantity;
        return $this;
    }

    /**
     * @return int
     */
    public function getTicketInitialQuantity()
    {
        return $this->ticketInitialQuantity;
    }

    /**
     * @param int $ticketInitialQuantity
     * @return Ticket
     */
    public function setTicketInitialQuantity($ticketInitialQuantity)
    {
        $this->ticketInitialQuantity = $ticketInitialQuantity;
        return $this;
    }

    /**
     * @return string
     */
    public function getTicketLot()
    {
        return $this->ticketLot;
    }

    /**
     * @param string $ticketLot
     * @return Ticket
     */
    public function setTicketLot($ticketLot)
    {
        $this->ticketLot = $ticketLot;
        return $this;
    }

    /**
     * @return int
     */
    public function getTicketPrice()
    {
        return $this->ticketPrice;
    }

    /**
     * @return int|string
     */
    public function getFormattedTicketPrice()
    {
        if ($this->ticketPrice) {
            $newValue = str_split($this->ticketPrice);

            $lastPosition = count($newValue) - 1;
            $antLastPosition = $lastPosition - 1;
            $strAfterDivider = "," . $newValue[$antLastPosition] . $newValue[$lastPosition];
            return "R$ " . substr($this->ticketPrice, 0, -2) . $strAfterDivider;
        }

        return $this->ticketPrice;
    }

    /**
     * @param $value
     * @return string
     */
    public function setFormattedTicketPrice($value)
    {
        if ($value) {
            $newValue = str_split($value);

            $lastPosition = count($newValue) - 1;
            $antLastPosition = $lastPosition - 1;
            $strAfterDivider = "," . $newValue[$antLastPosition] . $newValue[$lastPosition];
            return "R$ " . substr($value, 0, -2) . $strAfterDivider;
        }

        return $value;
    }

    /**
     * @param int $ticketPrice
     * @return Ticket
     */
    public function setTicketPrice($ticketPrice)
    {
        $this->ticketPrice = $ticketPrice;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getTicketCreatedAt()
    {
        return $this->ticketCreatedAt;
    }

    /**
     * @param \DateTime $ticketCreatedAt
     * @return Ticket
     */
    public function setTicketCreatedAt($ticketCreatedAt)
    {
        $this->ticketCreatedAt = $ticketCreatedAt;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getTicketUpdatedAt()
    {
        return $this->ticketUpdatedAt;
    }

    /**
     * @ORM\PreUpdate
     */
    public function setTicketUpdatedAt()
    {
        $this->ticketUpdatedAt = new \DateTime("now");
        return $this;
    }

    /**
     * @return Event
     */
    public function getEvent()
    {
        return $this->event;
    }

    /**
     * @param Event $event
     * @return Ticket
     */
    public function setEvent($event)
    {
        $this->event = $event;
        return $this;
    }

    /**
     * @return Cart
     */
    public function getCarts()
    {
        return $this->carts;
    }

    /**
     * @param Cart $carts
     * @return Ticket
     */
    public function setCarts($carts)
    {
        $this->carts = $carts;
        return $this;
    }
}