<?php

namespace Podorozhny\CoreBundle\Form\Frontend\DataTransformer\Frontend;

use Podorozhny\Manager\Frontend\UserManager;
use Podorozhny\Model\Frontend\UserInterface;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\UnexpectedTypeException;

class UserToEmailTransformer implements DataTransformerInterface {
    protected $userManager;

    public function __construct(UserManager $userManager) {
        $this->userManager = $userManager;
    }

    public function transform($value) {
        if (null === $value) {
            return null;
        }

        if (!$value instanceof UserInterface) {
            throw new UnexpectedTypeException($value, 'Podorozhny\Model\Frontend\UserInterface');
        }

        return $value->getEmail();
    }

    public function reverseTransform($value) {
        if (null === $value || '' === $value) {
            return null;
        }

        if (!is_string($value)) {
            throw new UnexpectedTypeException($value, 'string');
        }

        return $this->userManager->findByEmail($value);
    }
}