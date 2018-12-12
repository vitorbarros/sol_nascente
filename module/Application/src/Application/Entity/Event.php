<?php

namespace Application\Entity;

use Zend\Stdlib\Hydrator;
use Doctrine\ORM\Mapping as ORM;

/**
 * Event
 *
 * @ORM\Table(name="events")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="Application\Repository\EventRepository")
 */
class Event
{
    /**
     * @var integer
     *
     * @ORM\Column(name="event_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $eventId;

    /**
     * @var string
     *
     * @ORM\Column(name="event_name", type="string", length=255, nullable=false)
     */
    private $eventName;

    /**
     * @var string
     *
     * @ORM\Column(name="event_description", type="string", length=255, nullable=false)
     */
    private $eventDescription;


    /**
     * @var string
     *
     * @ORM\Column(name="event_excerpt", type="string", length=255, nullable=false)
     */
    private $eventExcerpt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="event_start_at", type="datetime", nullable=false)
     */
    private $eventStartAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="event_finish_at", type="datetime", nullable=false)
     */
    private $eventFinishAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="event_created_at", type="datetime", nullable=false)
     */
    private $eventCreatedAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="event_updated_at", type="datetime", nullable=false)
     */
    private $eventUpdatedAt;

    /**
     * @var integer
     *
     * @ORM\Column(name="client_status", type="integer", nullable=false)
     */
    private $eventStatus;

    /**
     * @var Ticket
     *
     * One Category has Many Categories.
     * @ORM\OneToMany(targetEntity="Ticket", mappedBy="event")
     */
    private $tickets;

    public function __construct(array $options = [])
    {
        (new Hydrator\ClassMethods())->hydrate($options, $this);
        $this->eventCreatedAt = new \DateTime("now");
        $this->eventUpdatedAt = new \DateTime("now");
        $this->eventStatus = 1;
    }

    /**
     * @return int
     */
    public function getEventId()
    {
        return $this->eventId;
    }

    /**
     * @param int $eventId
     * @return Event
     */
    public function setEventId($eventId)
    {
        $this->eventId = $eventId;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEventName()
    {
        return $this->eventName;
    }

    /**
     * @param mixed $eventName
     * @return Event
     */
    public function setEventName($eventName)
    {
        $this->eventName = $eventName;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEventDescription()
    {
        return $this->eventDescription;
    }

    /**
     * @param mixed $eventDescription
     * @return Event
     */
    public function setEventDescription($eventDescription)
    {
        $this->eventDescription = $eventDescription;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEventStartAt()
    {
        return $this->eventStartAt;
    }

    /**
     * @param mixed $eventStartAt
     * @return Event
     */
    public function setEventStartAt($eventStartAt)
    {
        $this->eventStartAt = $eventStartAt;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEventFinishAt()
    {
        return $this->eventFinishAt;
    }

    /**
     * @param mixed $eventFinishAt
     * @return Event
     */
    public function setEventFinishAt($eventFinishAt)
    {
        $this->eventFinishAt = $eventFinishAt;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEventCreatedAt()
    {
        return $this->eventCreatedAt;
    }

    /**
     * @param mixed $eventCreatedAt
     * @return Event
     */
    public function setEventCreatedAt($eventCreatedAt)
    {
        $this->eventCreatedAt = $eventCreatedAt;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEventUpdatedAt()
    {
        return $this->eventUpdatedAt;
    }

    /**
     * @param mixed $eventUpdatedAt
     * @return Event
     */
    public function setEventUpdatedAt($eventUpdatedAt)
    {
        $this->eventUpdatedAt = $eventUpdatedAt;
        return $this;
    }

    /**
     * @return int
     */
    public function getEventStatus()
    {
        return $this->eventStatus;
    }

    /**
     * @param int $eventStatus
     * * @return Event
     */
    public function setEventStatus($eventStatus)
    {
        $this->eventStatus = $eventStatus;
        return $this;
    }

    /**
     * @return string
     */
    public function getEventExcerpt()
    {
        return $this->eventExcerpt;
    }

    /**
     * @param string $eventExcerpt
     * @return Event
     */
    public function setEventExcerpt($eventExcerpt)
    {
        $this->eventExcerpt = $eventExcerpt;
        return $this;
    }

    /**
     * @return Ticket
     */
    public function getTickets()
    {
        return $this->tickets;
    }

    /**
     * @param Ticket $tickets
     * @return Event
     */
    public function setTickets($tickets)
    {
        $this->tickets = $tickets;
        return $this;
    }
}