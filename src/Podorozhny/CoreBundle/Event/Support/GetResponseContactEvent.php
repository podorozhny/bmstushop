<?php

namespace Podorozhny\CoreBundle\Event\Support;

use Symfony\Component\HttpFoundation\Response;

class GetResponseContactEvent extends ContactEvent {
    private $response;

    public function setResponse(Response $response) {
        $this->response = $response;
    }

    public function getResponse() {
        return $this->response;
    }
}