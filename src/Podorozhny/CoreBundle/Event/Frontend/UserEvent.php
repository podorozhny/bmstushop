<?php

namespace Podorozhny\CoreBundle\Event\Frontend;

use Podorozhny\Model\Frontend\UserInterface;
use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\HttpFoundation\Request;

class UserEvent extends Event {
    private $request;
    private $user;

    public function __construct(UserInterface $user, Request $request) {
        $this->user    = $user;
        $this->request = $request;
    }

    public function getUser() {
        return $this->user;
    }

    public function getRequest() {
        return $this->request;
    }
}