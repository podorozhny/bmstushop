<?php

namespace Podorozhny\CoreBundle\Event\Support;

use Podorozhny\Model\Support\ContactInterface;
use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\HttpFoundation\Request;

class ContactEvent extends Event {
    private $request;
    private $contact;

    public function __construct(ContactInterface $contact, Request $request) {
        $this->contact = $contact;
        $this->request = $request;
    }

    public function getContact() {
        return $this->contact;
    }

    public function getRequest() {
        return $this->request;
    }
}