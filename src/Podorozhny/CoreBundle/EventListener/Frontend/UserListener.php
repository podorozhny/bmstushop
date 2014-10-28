<?php

namespace Podorozhny\CoreBundle\EventListener\Frontend;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Events;
use Podorozhny\Model\Frontend\UserInterface;

class UserListener implements EventSubscriber {
    private $userManager;
    private $container;

    public function __construct(ContainerInterface $container) {
        $this->container = $container;
    }

    public function getSubscribedEvents() {
        return array(
            Events::prePersist,
            Events::preUpdate,
        );
    }

    public function prePersist($args) {
        $object = $args->getEntity();
        if ($object instanceof UserInterface) {
            $this->updateUserFields($object);
        }
    }

    public function preUpdate($args) {
        $object = $args->getEntity();
        if ($object instanceof UserInterface) {
            $this->updateUserFields($object);
            // We are doing a update, so we must force Doctrine to update the
            // changeset in case we changed something above
            $em   = $args->getEntityManager();
            $uow  = $em->getUnitOfWork();
            $meta = $em->getClassMetadata(get_class($object));
            $uow->recomputeSingleEntityChangeSet($meta, $object);
        }
    }

    protected function updateUserFields(UserInterface $user) {
        if (null === $this->userManager) {
            $this->userManager = $this->container->get('podorozhny.frontend.user_manager');
        }

        $this->userManager->updateCanonicalFields($user);
        $this->userManager->updatePassword($user);
    }
}