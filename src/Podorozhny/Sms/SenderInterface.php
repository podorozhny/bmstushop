<?php

namespace Podorozhny\Sms;

interface SenderInterface {
    public function send($phone, $text);

    public function sendMany(array $phones, $text);
}