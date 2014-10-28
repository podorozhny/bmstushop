<?php

namespace Podorozhny\Mailer;

abstract class AbstractMailer {
    protected $mailer;
    protected $parameters;

    public function __construct(MailerInterface $mailer, array $parameters) {
        $this->mailer     = $mailer;
        $this->parameters = $parameters;
    }

    protected function sendEmail(array $context, $toEmail, $toName = null) {
        $message = $this->mailer->create($this->parameters['template'], $context);
        $message->setFrom($this->parameters['from_address'], $this->parameters['from_name']);
        $message->setTo($toEmail, $toName);
        $this->mailer->send($message);
    }
}