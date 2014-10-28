<?php

namespace Podorozhny\Mailer;

interface MessageInterface {
    public function setFrom($email, $firstname = null, $lastname = null);

    public function setTo($email, $firstname = null, $lastname = null);
}