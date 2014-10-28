<?php

namespace Podorozhny\CoreBundle\EventListener;

use Podorozhny\Model\ImageInterface;
use Podorozhny\Uploader\ImageUploaderInterface;
use Podorozhny\CoreBundle\Exception\UnexpectedTypeException;
use Symfony\Component\EventDispatcher\GenericEvent;

class ImageUploadListener {
    protected $uploader;

    public function __construct(ImageUploaderInterface $uploader) {
        $this->uploader = $uploader;
    }

    public function uploadProductImage(GenericEvent $event) {
        $subject = $event->getSubject();

        if (!$subject instanceof ImageInterface) {
            throw new UnexpectedTypeException(
                $subject,
                'Podorozhny\Model\ImageInterface'
            );
        }

        if ($subject->hasFile()) {
            $this->uploader->upload($subject);
        }

        if (null === $subject->getPath()) {
            $subject->removeElement($subject);
        }
    }
}
