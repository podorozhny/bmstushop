<?php

namespace Podorozhny\Uploader;

use Podorozhny\Model\ImageInterface;

interface ImageUploaderInterface {
    public function upload(ImageInterface $image);

    public function remove($path);
}
