<?php

namespace Podorozhny\Mailer;

interface MailerInterface {
    public function create($templateName, $context);

    public function send(MessageInterface $message);
}