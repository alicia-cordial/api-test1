<?php 
namespace AppBundle\EventListener;

use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTCreatedEvent;

class JWTCreatedListener
    {

    /**
     * @param JWTCreatedEvent $event
     *
     * @return void
     */
    public function onJWTCreated(JWTCreatedEvent $event)
        {
            $user = $event->getUser();
            /** @var \App\Entity\User $user */
            $userId = $user->getId();

            $payload = $event->getData();
            $payload['id'] = $userId;

            $event->setData($payload);
            $header        = $event->getHeader();
            $event->setHeader($header);
        }
    }