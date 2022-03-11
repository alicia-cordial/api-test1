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
            $userIri = '/api/users/' . $userId;

            $payload = $event->getData();
            $payload['id'] = $userId;
            $payload['userIri'] = $userIri;

            $event->setData($payload);
            $header        = $event->getHeader();
            $event->setHeader($header);
        }
    }