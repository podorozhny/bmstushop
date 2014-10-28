<?php

namespace Podorozhny\Model\Support;

interface ContactSubjectInterface {
    public function getId();

    public function setName($name);

    public function getName();

    public function getContacts();
}
