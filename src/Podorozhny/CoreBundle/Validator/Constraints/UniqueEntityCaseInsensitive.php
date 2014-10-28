<?php

namespace Podorozhny\CoreBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

class UniqueEntityCaseInsensitive extends Constraint {
    public $message = 'This value is already used.';

    public $fields = array();

    public function getRequiredOptions() {
        return array('fields');
    }

    public function getDefaultOption() {
        return 'fields';
    }

    public function getTargets() {
        return self::CLASS_CONSTRAINT;
    }

    public function validatedBy() {
        return 'podorozhny.validator.unique_entity_case_insensitive';
    }
}