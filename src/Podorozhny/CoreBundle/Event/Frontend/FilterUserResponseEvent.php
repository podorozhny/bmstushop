<?php

namespace Podorozhny\CoreBundle\Event\Frontend;

use Podorozhny\Model\Frontend\UserInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class FilterUserResponseEvent extends UserEvent {
    private $response;

    public function __construct(UserInterface $user, Request $request, Response $response) {
        parent::__construct($user, $request);
        $this->response = $response;
    }

    public function getResponse() {
        return $this->response;
    }
}