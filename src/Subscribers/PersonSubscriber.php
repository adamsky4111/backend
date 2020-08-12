<?php


namespace App\Subscribers;


use App\Entity\Person;
use EasyCorp\Bundle\EasyAdminBundle\Event\AfterEntityDeletedEvent;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityUpdatedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class PersonSubscriber implements EventSubscriberInterface
{

    public static function getSubscribedEvents()
    {
        return [
            BeforeEntityPersistedEvent::class => ['setCreatedAt'],
            BeforeEntityUpdatedEvent::class => ['setUpdatedAt'],
        ];
    }

    public function setCreatedAt(BeforeEntityPersistedEvent $e)
    {
        $person = $e->getEntityInstance();

        if ($person instanceof Person) {
            $person->setUpdatedAt(new \DateTime('NOW'));
            $person->setCreatedAt(new \DateTime('NOW'));
        }
    }

    public function setUpdatedAt(BeforeEntityUpdatedEvent $e)
    {
        $person = $e->getEntityInstance();

        if ($person instanceof Person) {
            $person->setUpdatedAt(new \DateTime('NOW'));
        }
    }
}