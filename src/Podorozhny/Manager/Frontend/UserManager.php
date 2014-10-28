<?php

namespace Podorozhny\Manager\Frontend;

use Podorozhny\Manager\ObjectManager;
use Doctrine\ORM\EntityManager;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Podorozhny\Util\CanonicalizerInterface;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\User\UserInterface as SecurityUserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Podorozhny\Model\Frontend\UserInterface;

class UserManager extends ObjectManager implements UserProviderInterface {
    protected $encoderFactory;
    protected $emailCanonicalizer;

    public function __construct(EntityManager $entityManager, EventDispatcherInterface $eventDispatcher, $class, EncoderFactoryInterface $encoderFactory, CanonicalizerInterface $canonicalizer) {
        $this->entityManager   = $entityManager;
        $this->eventDispatcher = $eventDispatcher;
        $this->class           = $class;

        $this->encoderFactory     = $encoderFactory;
        $this->emailCanonicalizer = $canonicalizer;
    }

    public function getEncoderFactory() {
        return $this->encoderFactory;
    }

    public function getEmailCanonicalizer() {
        return $this->emailCanonicalizer;
    }

    public function findByEmail($email) {
        return $this->findOneBy(array('emailCanonical' => $this->canonicalizeEmail($email)));
    }

    public function findByConfirmationToken($token) {
        return $this->findOneBy(array('confirmationToken' => $token));
    }

    public function findByUsername($username) {
        return $this->findByEmail($username);
    }

    public function findByUsernameOrEmail($usernameOrEmail) {
        return $this->findByEmail($usernameOrEmail);
    }

    public function refreshUser(SecurityUserInterface $user) {
        // deprecated
    }

    public function loadUserByUsername($email) {
        // deprecated
    }

    public function loadUserByEmail($email) {
        // deprecated
    }

    public function reloadUser(UserInterface $user) {
        $this->getEntityManager()->refresh($user);
    }

    public function updateUser(UserInterface $user, $andFlush = true) {
        $this->updateCanonicalFields($user);
        $this->updatePassword($user);

        $this->update($user, $andFlush);
    }

    public function updateCanonicalFields(UserInterface $user) {
        $user->setEmailCanonical($this->canonicalizeEmail($user->getEmail()));
    }

    public function updatePassword(UserInterface $user) {
        if (0 !== strlen($password = $user->getPlainPassword())) {
            $encoder = $this->getEncoder($user);
            $user->setPassword($encoder->encodePassword($password, $user->getSalt()));
            $user->eraseCredentials();
        }
    }

    protected function canonicalizeEmail($email) {
        return $this->getEmailCanonicalizer()->canonicalize($email);
    }

    protected function getEncoder(UserInterface $user) {
        return $this->getEncoderFactory()->getEncoder($user);
    }

    public function supportsClass($class) {
        // deprecated
    }
}