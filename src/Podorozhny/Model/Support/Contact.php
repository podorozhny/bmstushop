<?php

namespace Podorozhny\Model\Support;

class Contact implements ContactInterface {
    protected $id;
    protected $createdAt;
    protected $firstname;
    protected $lastname;
    protected $email; // TODO
    protected $phone; // not null хотя бы одно из двух полей email и phone
    protected $subject;
    protected $message;
//    protected $useragent;
//    protected $ip;

    public function __construct() {
        $this->createdAt = new \DateTime();
    }

    public function getId() {
        return $this->id;
    }

    public function setCreatedAt(\DateTime $date = null) {
        $this->createdAt = $date;
        return $this;
    }

    public function getCreatedAt() {
        return $this->createdAt;
    }

    public function setFirstname($firstname) {
        $this->firstname = $firstname;
        return $this;
    }

    public function getFirstname() {
        return $this->firstname;
    }

    public function setLastname($lastname) {
        $this->lastname = $lastname;
        return $this;
    }

    public function getLastname() {
        return $this->lastname;
    }

    public function setEmail($email) {
        $this->email = $email;
        return $this;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setPhone($phone) {
        $this->phone = $phone;
        return $this;
    }

    public function getPhone() {
        return $this->phone;
    }

    public function setSubject(ContactSubjectInterface $subject) {
        $this->subject = $subject;
        return $this;
    }

    public function getSubject() {
        return $this->subject;
    }

    public function setMessage($message) {
        $this->message = $message;
        return $this;
    }

    public function getMessage() {
        return $this->message;
    }

//    public function setUseragent($useragent) {
//        $this->useragent = $useragent;
//        return $this;
//    }
//
//    public function getUseragent() {
//        return $this->useragent;
//    }
//
//    public function setIp($ip) {
//        $this->ip = $ip;
//        return $this;
//    }
//
//    public function getIp() {
//        return $this->ip;
//    }
}
