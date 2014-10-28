<?php

namespace Podorozhny\Model;

class Image implements ImageInterface {
    protected $id;
    protected $file;
    protected $path;
    protected $createdAt;
    protected $updatedAt;

    public function __construct() {
        $this->createdAt = new \DateTime();
    }

    public function getId() {
        return $this->id;
    }

    public function hasFile() {
        return null !== $this->file;
    }

    public function getFile() {
        return $this->file;
    }

    public function setFile(\SplFileInfo $file) {
        $this->file = $file;
        return $this;
    }

    public function hasPath() {
        return null !== $this->path;
    }

    public function getPath() {
        return $this->path;
    }

    public function setPath($path) {
        $this->path = $path;
        return $this;
    }

    public function getCreatedAt() {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTime $createdAt) {
        $this->createdAt = $createdAt;
        return $this;
    }

    public function getUpdatedAt() {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTime $updatedAt) {
        $this->updatedAt = $updatedAt;
        return $this;
    }
}