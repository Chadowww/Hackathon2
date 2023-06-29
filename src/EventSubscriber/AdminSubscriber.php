<?php

namespace App\EventSubscriber;

use App\Entity\Category;
use App\Entity\Memory;
use App\Entity\Smartphone;
use App\Entity\Storage;
use App\Entity\User;
use App\Entity\Year;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityUpdatedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class AdminSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return [
            BeforeEntityPersistedEvent::class => ['setCreatedAt'],
            BeforeEntityUpdatedEvent::class => ['setUpdatedAt']
        ];
    }

    public function setCreatedAt(BeforeEntityPersistedEvent $event)
    {
        $entityInstance = $event->getEntityInstance();
        if (!$entityInstance instanceof Category && !$entityInstance instanceof Memory && !$entityInstance instanceof Smartphone && !$entityInstance instanceof Storage && !$entityInstance instanceof User && !$entityInstance instanceof Year) return;

        $entityInstance->setCreatedAt(new \DateTime());
        $entityInstance->setUpdatedAt(new \DateTime());
    }

    public function setUpdatedAt(BeforeEntityUpdatedEvent $event)
    {
        $entityInstance = $event->getEntityInstance();
        if (!$entityInstance instanceof Category && !$entityInstance instanceof Memory && !$entityInstance instanceof Smartphone && !$entityInstance instanceof Storage && !$entityInstance instanceof User && !$entityInstance instanceof Year) return;

        $entityInstance->setUpdatedAt(new \DateTime());
    }
}