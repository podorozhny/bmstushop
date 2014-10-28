<?php

namespace Podorozhny\Model;

interface ImageInterface extends TimestampableInterface {
    public function hasFile();

    public function getFile();

    public function setFile(\SplFileInfo $file);

    public function getPath();

    public function setPath($path);
}