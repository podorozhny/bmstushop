<?php

namespace Podorozhny\CoreBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Bridge\Doctrine\RegistryInterface;

class UniqueEntityCaseInsensitiveValidator extends ConstraintValidator {
    private $registry;

    public function __construct(RegistryInterface $registry) {
        $this->registry = $registry;
    }

    public function isValid($entity, Constraint $constraint) {
        $fields = (array) $constraint->fields;

        $em         = $this->registry->getEntityManager();
        $entityName = $this->context->getCurrentClass();
        $class      = $em->getClassMetadata($entityName);

        $repository = $em->getRepository($entityName);
        $builder    = $repository->createQueryBuilder('x');

        foreach ($fields as $field) {
            if (isset($class->associationMappings[$field])) {
                $builder->andWhere('x.' . $field . ' = :' . $field);
            } else {
                $builder->andWhere(
                    'lower(x.' . $field . ') = lower(:' . $field . ')'
                );
            }

            $value = $class->reflFields[$field]->getValue($entity);
            $builder->setParameter($field, $value);
        }

        $result = $builder->getQuery()->getResult();

        if (count($result) && $result[0] !== $entity) {
            $this->context->addViolationAtSubPath($fields[0], $constraint->message, array($value));
        }

        return true;
    }
}
