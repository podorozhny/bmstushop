<?php

namespace Podorozhny\CoreBundle\Event\Frontend;

use Symfony\Component\HttpFoundation\Response;

class GetResponseUserEvent extends UserEvent {
    private $response;

    public function setResponse(Response $response) {
        $this->response = $response;
    }

    public function getResponse() {
        return $this->response;
    }
}