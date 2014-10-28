<?php

namespace Podorozhny\CoreBundle\Validator\Frontend;

use Podorozhny\Manager\Frontend\UserManager;
use Podorozhny\Model\Frontend\UserInterface;
use Symfony\Component\Validator\ObjectInitializerInterface;

class Initializer implements ObjectInitializerInterface {
    private $userManager;

    public function __construct(UserManager $userManager) {
        $this->userManager = $userManager;
    }

    public function initialize($object) {
        if ($object instanceof UserInterface) {
            $this->userManager->updateCanonicalFields($object);
        }
    }
}