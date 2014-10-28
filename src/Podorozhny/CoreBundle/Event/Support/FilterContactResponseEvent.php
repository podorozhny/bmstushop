<?php

namespace Podorozhny\CoreBundle\Event\Support;

use Podorozhny\Model\Support\ContactInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class FilterContactResponseEvent extends ContactEvent {
    private $response;

    public function __construct(ContactInterface $contact, Request $request, Response $response) {
        parent::__construct($contact, $request);
        $this->response = $response;
    }

    public function getResponse() {
        return $this->response;
    }
}