<?php

namespace Application\Fixture;

use Application\Entity\Event;
use Application\Entity\Ticket;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 30; $i++) {

            //criando o evento
            $event = new Event();
            $event->setEventName("Evento " . ($i + 1))
                ->setEventExcerpt("Lorem Ipsum é simplesmente uma simulação de texto da indústria tipográfica e de impressos, e vem sendo utilizado desde o século XVI, quando um...")
                ->setEventDescription("Lorem Ipsum é simplesmente uma simulação de texto da indústria tipográfica e de impressos, e vem sendo utilizado desde o século XVI, quando um impressor desconhecido pegou uma bandeja de tipos e os embaralhou para fazer um livro de modelos de tipos. Lorem Ipsum sobreviveu não só a cinco séculos, como também ao salto para a editoração eletrônica, permanecendo essencialmente inalterado. Se popularizou na década de 60, quando a Letraset lançou decalques contendo passagens de Lorem Ipsum, e mais recentemente quando passou a ser integrado a softwares de editoração eletrônica como Aldus PageMaker.")
                ->setEventStartAt(new \DateTime("now"))
                ->setEventFinishAt(new \DateTime("now +2 day"));

            //criando o ticket
            $ticket = new Ticket();
            $ticket->setTicketLot("Lote 1")
                ->setTicketQuantity(100)
                ->setTicketInitialQuantity(100)
                ->setTicketPrice(10000)
                ->setEvent($event);

            $manager->persist($event);
            $manager->persist($ticket);
            $manager->flush();
        }
    }

    /**
     * @return int
     */
    public function getOrder()
    {
        return 1;
    }
}