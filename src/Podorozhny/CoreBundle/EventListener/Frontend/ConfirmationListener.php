<?php

namespace Podorozhny\CoreBundle\EventListener\Frontend;

use Podorozhny\CoreBundle\Event\Frontend\UserEvent;
use Podorozhny\CoreBundle\Event\Frontend\UserEvents;
use Podorozhny\Mailer\Frontend\CustomerWelcomeMailer;
use Podorozhny\Manager\Frontend\UserManager;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class ConfirmationListener implements EventSubscriberInterface {
    private $userManager;
    private $customerWelcomeMailer;

    public function __construct(UserManager $userManager, CustomerWelcomeMailer $customerWelcomeMailer) {
        $this->userManager             = $userManager;
        $this->customerWelcomeMailer   = $customerWelcomeMailer;
    }

    public static function getSubscribedEvents() {
        return array(
            UserEvents::REGISTRATION_COMPLETED => 'onRegistrationSuccess',
        );
    }

    public function onRegistrationSuccess(UserEvent $event) {
        $user = $event->getUser();

        $user->setEnabled(false);
        $user->createConfirmation();
        $this->userManager->update($user);

        $this->customerWelcomeMailer->send($user);

//        $url = $this->router->generate('fos_user_registration_check_email');
//        $event->setResponse(new RedirectResponse($url));
    }
}