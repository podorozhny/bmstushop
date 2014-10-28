<?php

namespace Podorozhny\Mailer\Support;

use Podorozhny\Mailer\MailerInterface;
use Podorozhny\Model\Support\ContactInterface;

class ContactMailer {
    protected $mailer;
    protected $parameters;

    public function __construct(MailerInterface $mailer, array $parameters) {
        $this->mailer     = $mailer;
        $this->parameters = $parameters;
    }

    public function send(ContactInterface $contact) {
        $message = $this->mailer->create($this->parameters['template'], array('contact' => $contact));
        $message->setFrom($this->parameters['from_address'], $this->parameters['from_name']);
        $message->setTo($this->parameters['to_address'], $this->parameters['to_name']);
        $this->mailer->send($message);
    }
}