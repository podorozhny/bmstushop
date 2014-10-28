<?php

namespace Podorozhny\CoreBundle\EventListener\Frontend;

use Podorozhny\CoreBundle\Event\Frontend\UserEvents;
use Podorozhny\CoreBundle\Event\Frontend\UserEvent;
use Podorozhny\CoreBundle\Event\Frontend\FilterUserResponseEvent;
use Podorozhny\CoreBundle\Security\Frontend\LoginManagerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Core\Exception\AccountStatusException;

class AuthenticationListener implements EventSubscriberInterface {
    private $loginManager;
    private $firewallName;

    public function __construct(LoginManagerInterface $loginManager, $firewallName) {
        $this->loginManager = $loginManager;
        $this->firewallName = $firewallName;
    }

    public static function getSubscribedEvents() {
        return array(
            UserEvents::REGISTRATION_CONFIRMED    => 'authenticate',
        );
    }

    public function authenticate(FilterUserResponseEvent $event) {
        if (!$event->getUser()->isEnabled() || $event->getUser()->isLocked()) {
            return;
        }

        try {
            $this->loginManager->loginUser($this->firewallName, $event->getUser(), $event->getResponse());

            $event->getDispatcher()->dispatch(UserEvents::SECURITY_IMPLICIT_LOGIN, new UserEvent($event->getUser(), $event->getRequest()));
        } catch (AccountStatusException $ex) {
            // We simply do not authenticate users which do not pass the user
            // checker (not enabled, expired, etc.).
        }
    }
}
