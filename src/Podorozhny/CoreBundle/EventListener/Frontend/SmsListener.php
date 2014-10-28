<?php

namespace Podorozhny\CoreBundle\EventListener\Frontend;

use Podorozhny\CoreBundle\Event\Frontend\UserEvents;
use Podorozhny\CoreBundle\Event\Frontend\UserEvent;
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
            UserEvents::REGISTRATION_COMPLETED => 'notifyNewCustomer',
        );
    }

    public function notifyNewCustomer(UserEvent $event) {
        $this->smsSender->send($this->number, 'Новый пользователь на сайте BMSTUShop');
    }
}