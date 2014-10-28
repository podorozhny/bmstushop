<?php

namespace Podorozhny\Sms;

use Zelenin\Smsru;

class Sender implements SenderInterface {
    protected $smsru;
    protected $senderName;

    public function __construct(Smsru $smsru, $senderName) {
        $this->smsru      = $smsru;
        $this->senderName = $senderName;
    }

    public function send($phone, $text) {
        return $this->sendSms([$phone], $text);
    }

    public function sendMany(array $phones, $text) {
        return $this->sendSms($phones, $text);
    }

    protected function sendSms(array $phones, $text) {
        $phones = implode(',', $phones);
        $test   = false;

        return $this->smsru->smsSend($phones, $text, $this->senderName, null, false, $test, null);
    }
}