<?php

namespace Podorozhny\Mailer;

use Mailgun\Mailgun;

class MailgunMailer implements MailerInterface {
    protected $mailgun;
    protected $twig;
    protected $domain;

    public function __construct(Mailgun $mailgun, \Twig_Environment $twig, $domain) {
        $this->mailgun = $mailgun;
        $this->twig    = $twig;
        $this->domain  = $domain;
    }

    public function create($templateName, $context) {
        $context  = $this->twig->mergeGlobals($context);
        $template = $this->twig->loadTemplate($templateName);

        $subject  = $template->renderBlock('subject', $context);
        $htmlBody = $template->renderBlock('body_html', $context);

        $message = new MailgunMessage;
        $message->setSubject($subject);
        if (!empty($htmlBody)) {
            $message->setHtmlBody($htmlBody);
        } else {
            $textBody = $template->renderBlock('body_text', $context);
            $message->setTextBody($textBody);
        }

        return $message;
    }

    public function send(MessageInterface $message) {
        $this->mailgun->sendMessage($this->domain, $message->getMessage(), $message->getFiles());
    }
}