<?php

namespace Podorozhny\CoreBundle\EventListener\Frontend;

use Podorozhny\CoreBundle\Event\Frontend\UserEvents;
use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Translation\TranslatorInterface;

class FlashListener implements EventSubscriberInterface {
    private $session;
    private $translator;

    private static $successMessages
        = array(
            UserEvents::REGISTRATION_COMPLETED => 'Пройдите по ссылке из письма для завершения регистрации.',
            UserEvents::REGISTRATION_CONFIRMED => 'Ваш аккаунт успешно активирован. Добро пожаловать!',
        );

    public function __construct(Session $session, TranslatorInterface $translator) {
        $this->session    = $session;
        $this->translator = $translator;
    }

    public static function getSubscribedEvents() {
        return array(
            UserEvents::REGISTRATION_COMPLETED => 'addSuccessFlash',
            UserEvents::REGISTRATION_CONFIRMED => 'addSuccessFlash',
        );
    }

    public function addSuccessFlash(Event $event) {
        if (!isset(self::$successMessages[$event->getName()])) {
            throw new \InvalidArgumentException('This event does not correspond to a known flash message');
        }

        $this->session->getFlashBag()->add('success', $this->trans(self::$successMessages[$event->getName()]));
    }

    private function trans($message, array $params = array()) {
        return $this->translator->trans($message, $params, 'CoreBundle');
    }
}