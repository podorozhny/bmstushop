<?php

namespace Podorozhny\Model\Frontend;

use Symfony\Component\Security\Core\User\AdvancedUserInterface;

interface UserInterface extends AdvancedUserInterface, \Serializable {
    const ROLE_DEFAULT = 'ROLE_USER';
    const CONFIRMATION_EXPIRATION_TIME = 86400;

    public function getId();

    public function setCreatedAt(\DateTime $date);

    public function getCreatedAt();

    public function setLastLoginAt(\DateTime $date);

    public function getLastLoginAt();

    public function setEmail($email);

    public function getEmail();

    public function setEmailCanonical($emailCanonical);

    public function getEmailCanonical();

    public function setPassword($password);

    public function getPassword();

    public function setPlainPassword($password);

    public function getPlainPassword();

    public function setSalt($salt);

    public function getSalt();

    public function setEnabled($boolean);

    public function isEnabled();

    public function setLocked($boolean);

    public function isLocked();

    public function setConfirmationToken($token);

    public function getConfirmationToken();

    public function setConfirmationExpiresAt(\DateTime $date);

    public function getConfirmationExpiresAt();

    public function isConfirmationNonExpired();

    public function setFirstname($firstname);

    public function getFirstname();

    public function setLastname($lastname);

    public function getLastname();
}