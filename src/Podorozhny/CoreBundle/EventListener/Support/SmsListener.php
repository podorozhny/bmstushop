<?php

namespace Podorozhny\CoreBundle\EventListener\Support;

use Podorozhny\CoreBundle\Event\Support\ContactEvent;
use Podorozhny\CoreBundle\Event\Support\ContactEvents;
use Podorozhny\Sms\SenderInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class SmsListener implements EventSubscriberInterface {
    private $smsSender;
    private $number = '79262710058';

    public function __construct(SenderInterface $smsSender) {
        $this->smsSender = $smsSender;
    }

    public static function getSubscribedEvents() {
        return array(
            ContactEvents::CREATED => 'notifyNewContact',
        );
    }

    public function notifyNewContact(ContactEvent $event) {
        $this->smsSender->send($this->number, 'Новое обращение на сайте BMSTUShop');
    }
}