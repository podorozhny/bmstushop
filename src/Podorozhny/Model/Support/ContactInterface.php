<?php

namespace Podorozhny\Model\Support;

interface ContactInterface {
    public function getId();

    public function setCreatedAt(\DateTime $date);

    public function getCreatedAt();

    public function setFirstname($firstname);

    public function getFirstname();

    public function setLastname($lastname);

    public function getLastname();

    public function setEmail($email);

    public function getEmail();

    public function setSubject(ContactSubjectInterface $subject);

    public function getSubject();

    public function setMessage($message);

    public function getMessage();
}
