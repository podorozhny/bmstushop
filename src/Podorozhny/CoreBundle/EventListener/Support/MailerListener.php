<?php

namespace Podorozhny\CoreBundle\EventListener\Support;

use Podorozhny\CoreBundle\Event\Support\ContactEvent;
use Podorozhny\CoreBundle\Event\Support\ContactEvents;
use Podorozhny\Mailer\Support\ContactMailer;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class MailerListener implements EventSubscriberInterface {
    private $contactMailer;

    public function __construct(ContactMailer $contactMailer) {
        $this->contactMailer = $contactMailer;
    }

    public static function getSubscribedEvents() {
        return array(
            ContactEvents::CREATED => 'contact',
        );
    }

    public function contact(ContactEvent $event) {
        $contact = $event->getContact();
        $this->contactMailer->send($contact);
    }
}