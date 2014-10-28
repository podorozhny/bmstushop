<?php

namespace Podorozhny\Mailer\Frontend;

use Podorozhny\Mailer\AbstractMailer;
use Podorozhny\Model\Frontend\UserInterface;

class CustomerWelcomeMailer extends AbstractMailer {
    public function send(UserInterface $user) {
        $this->sendEmail(array('user' => $user), $user->getEmail());
    }
}