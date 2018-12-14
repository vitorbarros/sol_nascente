<?php

namespace DoctrineORMModule\Proxy\__CG__\Application\Entity;

/**
 * DO NOT EDIT THIS FILE - IT WAS CREATED BY DOCTRINE'S PROXY GENERATOR
 */
class Event extends \Application\Entity\Event implements \Doctrine\ORM\Proxy\Proxy
{
    /**
     * @var \Closure the callback responsible for loading properties in the proxy object. This callback is called with
     *      three parameters, being respectively the proxy object to be initialized, the method that triggered the
     *      initialization process and an array of ordered parameters that were passed to that method.
     *
     * @see \Doctrine\Common\Persistence\Proxy::__setInitializer
     */
    public $__initializer__;

    /**
     * @var \Closure the callback responsible of loading properties that need to be copied in the cloned object
     *
     * @see \Doctrine\Common\Persistence\Proxy::__setCloner
     */
    public $__cloner__;

    /**
     * @var boolean flag indicating if this object was already initialized
     *
     * @see \Doctrine\Common\Persistence\Proxy::__isInitialized
     */
    public $__isInitialized__ = false;

    /**
     * @var array properties to be lazy loaded, with keys being the property
     *            names and values being their default values
     *
     * @see \Doctrine\Common\Persistence\Proxy::__getLazyProperties
     */
    public static $lazyPropertiesDefaults = [];



    /**
     * @param \Closure $initializer
     * @param \Closure $cloner
     */
    public function __construct($initializer = null, $cloner = null)
    {

        $this->__initializer__ = $initializer;
        $this->__cloner__      = $cloner;
    }







    /**
     * 
     * @return array
     */
    public function __sleep()
    {
        if ($this->__isInitialized__) {
            return ['__isInitialized__', '' . "\0" . 'Application\\Entity\\Event' . "\0" . 'eventId', '' . "\0" . 'Application\\Entity\\Event' . "\0" . 'eventName', '' . "\0" . 'Application\\Entity\\Event' . "\0" . 'eventDescription', '' . "\0" . 'Application\\Entity\\Event' . "\0" . 'eventExcerpt', '' . "\0" . 'Application\\Entity\\Event' . "\0" . 'eventStartAt', '' . "\0" . 'Application\\Entity\\Event' . "\0" . 'eventFinishAt', '' . "\0" . 'Application\\Entity\\Event' . "\0" . 'eventCreatedAt', '' . "\0" . 'Application\\Entity\\Event' . "\0" . 'eventUpdatedAt', '' . "\0" . 'Application\\Entity\\Event' . "\0" . 'eventStatus', '' . "\0" . 'Application\\Entity\\Event' . "\0" . 'tickets', '' . "\0" . 'Application\\Entity\\Event' . "\0" . 'version'];
        }

        return ['__isInitialized__', '' . "\0" . 'Application\\Entity\\Event' . "\0" . 'eventId', '' . "\0" . 'Application\\Entity\\Event' . "\0" . 'eventName', '' . "\0" . 'Application\\Entity\\Event' . "\0" . 'eventDescription', '' . "\0" . 'Application\\Entity\\Event' . "\0" . 'eventExcerpt', '' . "\0" . 'Application\\Entity\\Event' . "\0" . 'eventStartAt', '' . "\0" . 'Application\\Entity\\Event' . "\0" . 'eventFinishAt', '' . "\0" . 'Application\\Entity\\Event' . "\0" . 'eventCreatedAt', '' . "\0" . 'Application\\Entity\\Event' . "\0" . 'eventUpdatedAt', '' . "\0" . 'Application\\Entity\\Event' . "\0" . 'eventStatus', '' . "\0" . 'Application\\Entity\\Event' . "\0" . 'tickets', '' . "\0" . 'Application\\Entity\\Event' . "\0" . 'version'];
    }

    /**
     * 
     */
    public function __wakeup()
    {
        if ( ! $this->__isInitialized__) {
            $this->__initializer__ = function (Event $proxy) {
                $proxy->__setInitializer(null);
                $proxy->__setCloner(null);

                $existingProperties = get_object_vars($proxy);

                foreach ($proxy->__getLazyProperties() as $property => $defaultValue) {
                    if ( ! array_key_exists($property, $existingProperties)) {
                        $proxy->$property = $defaultValue;
                    }
                }
            };

        }
    }

    /**
     * 
     */
    public function __clone()
    {
        $this->__cloner__ && $this->__cloner__->__invoke($this, '__clone', []);
    }

    /**
     * Forces initialization of the proxy
     */
    public function __load()
    {
        $this->__initializer__ && $this->__initializer__->__invoke($this, '__load', []);
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __isInitialized()
    {
        return $this->__isInitialized__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setInitialized($initialized)
    {
        $this->__isInitialized__ = $initialized;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setInitializer(\Closure $initializer = null)
    {
        $this->__initializer__ = $initializer;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __getInitializer()
    {
        return $this->__initializer__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setCloner(\Closure $cloner = null)
    {
        $this->__cloner__ = $cloner;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific cloning logic
     */
    public function __getCloner()
    {
        return $this->__cloner__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     * @static
     */
    public function __getLazyProperties()
    {
        return self::$lazyPropertiesDefaults;
    }

    
    /**
     * {@inheritDoc}
     */
    public function getEventId()
    {
        if ($this->__isInitialized__ === false) {
            return (int)  parent::getEventId();
        }


        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getEventId', []);

        return parent::getEventId();
    }

    /**
     * {@inheritDoc}
     */
    public function setEventId($eventId)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setEventId', [$eventId]);

        return parent::setEventId($eventId);
    }

    /**
     * {@inheritDoc}
     */
    public function getEventName()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getEventName', []);

        return parent::getEventName();
    }

    /**
     * {@inheritDoc}
     */
    public function setEventName($eventName)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setEventName', [$eventName]);

        return parent::setEventName($eventName);
    }

    /**
     * {@inheritDoc}
     */
    public function getEventDescription()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getEventDescription', []);

        return parent::getEventDescription();
    }

    /**
     * {@inheritDoc}
     */
    public function setEventDescription($eventDescription)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setEventDescription', [$eventDescription]);

        return parent::setEventDescription($eventDescription);
    }

    /**
     * {@inheritDoc}
     */
    public function getEventStartAt()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getEventStartAt', []);

        return parent::getEventStartAt();
    }

    /**
     * {@inheritDoc}
     */
    public function setEventStartAt($eventStartAt)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setEventStartAt', [$eventStartAt]);

        return parent::setEventStartAt($eventStartAt);
    }

    /**
     * {@inheritDoc}
     */
    public function getEventFinishAt()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getEventFinishAt', []);

        return parent::getEventFinishAt();
    }

    /**
     * {@inheritDoc}
     */
    public function setEventFinishAt($eventFinishAt)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setEventFinishAt', [$eventFinishAt]);

        return parent::setEventFinishAt($eventFinishAt);
    }

    /**
     * {@inheritDoc}
     */
    public function getEventCreatedAt()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getEventCreatedAt', []);

        return parent::getEventCreatedAt();
    }

    /**
     * {@inheritDoc}
     */
    public function setEventCreatedAt($eventCreatedAt)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setEventCreatedAt', [$eventCreatedAt]);

        return parent::setEventCreatedAt($eventCreatedAt);
    }

    /**
     * {@inheritDoc}
     */
    public function getEventUpdatedAt()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getEventUpdatedAt', []);

        return parent::getEventUpdatedAt();
    }

    /**
     * {@inheritDoc}
     */
    public function setEventUpdatedAt()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setEventUpdatedAt', []);

        return parent::setEventUpdatedAt();
    }

    /**
     * {@inheritDoc}
     */
    public function getEventStatus()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getEventStatus', []);

        return parent::getEventStatus();
    }

    /**
     * {@inheritDoc}
     */
    public function setEventStatus($eventStatus)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setEventStatus', [$eventStatus]);

        return parent::setEventStatus($eventStatus);
    }

    /**
     * {@inheritDoc}
     */
    public function getEventExcerpt()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getEventExcerpt', []);

        return parent::getEventExcerpt();
    }

    /**
     * {@inheritDoc}
     */
    public function setEventExcerpt($eventExcerpt)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setEventExcerpt', [$eventExcerpt]);

        return parent::setEventExcerpt($eventExcerpt);
    }

    /**
     * {@inheritDoc}
     */
    public function getTickets()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getTickets', []);

        return parent::getTickets();
    }

    /**
     * {@inheritDoc}
     */
    public function setTickets($tickets)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setTickets', [$tickets]);

        return parent::setTickets($tickets);
    }

    /**
     * {@inheritDoc}
     */
    public function getVersion()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getVersion', []);

        return parent::getVersion();
    }

    /**
     * {@inheritDoc}
     */
    public function setVersion($version)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setVersion', [$version]);

        return parent::setVersion($version);
    }

}
