<?php

namespace Podorozhny\Model\Frontend;

use Doctrine\Common\Collections\ArrayCollection;

class User implements UserInterface {
    protected $id;
    protected $createdAt;
    protected $lastLoginAt; // TODO поменять на $lastActivityAt (или добавить новое поле)
    protected $username;
    protected $email;
    protected $emailCanonical;
    protected $password;
    protected $plainPassword;
    protected $salt;
    protected $enabled;
    protected $locked;
    protected $confirmationToken;
    protected $confirmationExpiresAt;
    protected $roles;
    protected $firstname;
    protected $lastname;

    public function __construct() {
        $this->createdAt = new \DateTime();
        $this->salt      = md5(base_convert(sha1(uniqid(mt_rand(), true)), 16, 36));
        $this->enabled   = false;
        $this->locked    = false;
        $this->roles     = new ArrayCollection();
    }

    public function __toString() {
        return (string) $this->getName();
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

    public function setLastLoginAt(\DateTime $time = null) {
        $this->lastLoginAt = $time;
        return $this;
    }

    public function getLastLoginAt() {
        return $this->lastLoginAt;
    }

    /**
     * // TODO
     * @deprecated
     */
    public function getUsername() {
        return $this->getEmail();
    }

    public function setEmail($email) {
        $this->email = $email;
        return $this;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmailCanonical($emailCanonical) {
        $this->emailCanonical = $emailCanonical;
        return $this;
    }

    public function getEmailCanonical() {
        return $this->emailCanonical;
    }

    public function setPassword($password) {
        $this->password = $password;
        return $this;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setPlainPassword($password) {
        $this->plainPassword = $password;
        return $this;
    }

    public function getPlainPassword() {
        return $this->plainPassword;
    }

    public function setSalt($salt) {
        $this->salt = $salt;
        return $this;
    }

    public function getSalt() {
        return $this->salt;
    }

    public function setEnabled($boolean) {
        $this->enabled = (Boolean) $boolean;
        return $this;
    }

    public function isEnabled() {
        return $this->enabled;
    }

    public function setLocked($boolean) {
        $this->locked = (Boolean) $boolean;
        return $this;
    }

    public function isLocked() {
        return !$this->isAccountNonLocked();
    }

    public function setConfirmationToken($token) {
        $this->confirmationToken = $token;
        return $this;
    }

    public function getConfirmationToken() {
        return $this->confirmationToken;
    }

    public function setConfirmationExpiresAt(\DateTime $date = null) {
        $this->confirmationExpiresAt = $date;
        return $this;
    }

    public function getConfirmationExpiresAt() {
        return $this->confirmationExpiresAt;
    }

    public function isConfirmationNonExpired() {
        return $this->confirmationExpiresAt instanceof \DateTime &&
               $this->confirmationExpiresAt->getTimestamp() > time();
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

    public function getRoles() {
        return ['ROLE_USER'];
    }

    public function hasRole($role) {
        return in_array(strtoupper($role), $this->getRoles(), true);
    }

    public function isUser(UserInterface $user = null) {
        return null !== $user && $this->getId() === $user->getId();
    }

    public function setSuperAdmin($boolean) {
        // do nothing
        return $this;
    }

    public function isSuperAdmin() {
        return false;
    }

    public function serialize() {
        return serialize(array(
                             $this->id,
                             $this->createdAt,
                             $this->email,
                             $this->password,
                             $this->salt,
                             $this->enabled,
                             $this->locked,
                         ));
    }

    public function unserialize($serialized) {
        $data = unserialize($serialized);
        list(
            $this->id,
            $this->createdAt,
            $this->email,
            $this->password,
            $this->salt,
            $this->enabled,
            $this->locked,
            )
            = $data;
    }

    public function eraseCredentials() {
        $this->plainPassword = null;
    }

    public function isAccountNonExpired() {
        return true;
    }

    public function isAccountNonLocked() {
        return !$this->locked;
    }

    public function isCredentialsNonExpired() {
        return true;
    }

    public function isCredentialsExpired() {
        return !$this->isCredentialsNonExpired();
    }

    public function createConfirmation() {
        $this->confirmationToken     = md5(base_convert(sha1(uniqid(mt_rand(), true)), 16, 36));
        $this->confirmationExpiresAt = (new \DateTime())->setTimestamp(time() + static::CONFIRMATION_EXPIRATION_TIME);
    }

    public function deleteConfirmation() {
        $this->confirmationToken     = null;
        $this->confirmationExpiresAt = null;
    }
}