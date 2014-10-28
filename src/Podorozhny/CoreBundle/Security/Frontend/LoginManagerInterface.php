<?php

namespace Podorozhny\CoreBundle\Security\Frontend;

use Podorozhny\Model\Frontend\UserInterface;
use Symfony\Component\HttpFoundation\Response;

interface LoginManagerInterface {
    public function loginUser($firewallName, UserInterface $user, Response $response = null);
}