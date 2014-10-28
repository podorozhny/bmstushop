<?php

namespace Podorozhny\Mailer;

use Mailgun\Messages\MessageBuilder;

class MailgunMessage extends MessageBuilder implements MessageInterface {
    public function __construct() {
        $this->setDkim(true);
    }

    public function setFrom($email, $firstname = null, $lastname = null) {
        $variables = array();
        if (!is_null($firstname)) {
            $variables['first'] = $firstname;
        }
        if (!is_null($lastname)) {
            $variables['last'] = $lastname;
        }
        $this->setFromAddress($email, count($variables) ? $variables : null);
    }

    public function setTo($email, $firstname = null, $lastname = null) {
        $variables = array();
        if (!is_null($firstname)) {
            $variables['first'] = $firstname;
        }
        if (!is_null($lastname)) {
            $variables['last'] = $lastname;
        }
        $this->addToRecipient($email, count($variables) ? $variables : null);
    }
}