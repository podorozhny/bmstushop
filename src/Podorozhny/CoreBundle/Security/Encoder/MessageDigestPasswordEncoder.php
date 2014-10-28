<?php

namespace Podorozhny\CoreBundle\Security\Encoder;

use Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder as BaseMessageDigestPasswordEncoder;

class MessageDigestPasswordEncoder extends BaseMessageDigestPasswordEncoder {
    private $algorithm;
    private $encodeHashAsBase64;
    private $iterations;

    protected function demergePasswordAndSalt($mergedPasswordSalt) {
        throw new \BadMethodCallException('Password and salt cannot be demerged.');
    }

    protected function mergePasswordAndSalt($password, $salt) {
        return hash($this->algorithm, hash($this->algorithm, $salt, true) . hash($this->algorithm, $password, true), true);
    }

    public function encodePassword($raw, $salt) {
        if ($this->isPasswordTooLong($raw)) {
            throw new BadCredentialsException('Invalid password.');
        }
        if (!in_array($this->algorithm, hash_algos(), true)) {
            throw new \LogicException(sprintf('The algorithm "%s" is not supported.', $this->algorithm));
        }
        $salted = $this->mergePasswordAndSalt($raw, $salt);
        $digest = hash($this->algorithm, hash($this->algorithm, $salted, true), true);
        for ($i = 1; $i < $this->iterations; $i++) {
            $digest = hash($this->algorithm, $digest . $salted, true);
        }
        return $this->encodeHashAsBase64 ? base64_encode($digest) : bin2hex($digest);
    }
}
