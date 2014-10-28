<?php

namespace Podorozhny\CoreBundle\EventListener\Frontend;

use Podorozhny\CoreBundle\Event\Frontend\UserEvents;
use Podorozhny\CoreBundle\Event\Frontend\UserEvent;
use Podorozhny\Manager\Frontend\UserManager;
use Podorozhny\Model\Frontend\UserInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;
use Symfony\Component\Security\Http\SecurityEvents;

class LastLoginListener implements EventSubscriberInterface {
    protected $userManager;

    public function __construct(UserManager $userManager) {
        $this->userManager = $userManager;
    }

    public static function getSubscribedEvents() {
        return array(
            UserEvents::SECURITY_IMPLICIT_LOGIN => 'onImplicitLogin',
            SecurityEvents::INTERACTIVE_LOGIN   => 'onSecurityInteractiveLogin',
        );
    }

    public function onImplicitLogin(UserEvent $event) {
        $user = $event->getUser();

        $user->setLastLoginAt(new \DateTime());
        $this->userManager->updateUser($user);
    }

    public function onSecurityInteractiveLogin(InteractiveLoginEvent $event) {
        $user = $event->getAuthenticationToken()->getUser();

        if ($user instanceof UserInterface) {
            $user->setLastLoginAt(new \DateTime());
            $this->userManager->updateUser($user);
        }
    }
}