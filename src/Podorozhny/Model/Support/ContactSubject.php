<?php

namespace Podorozhny\Model\Support;

use Doctrine\Common\Collections\ArrayCollection;

class ContactSubject implements ContactSubjectInterface {
    protected $id;
    protected $name;
    protected $contacts;

    public function __construct($name = null) {
        if (!is_null($name)) {
            $this->name = $name;
        }
        $this->contacts = new ArrayCollection();
    }

    public function __toString() {
        return (string) $this->getName();
    }

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
        return $this;
    }

    public function getContacts() {
        return $this->contacts;
    }
}
