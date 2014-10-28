<?php

namespace Podorozhny\Model\Shop;

use Doctrine\Common\Collections\ArrayCollection;
use Podorozhny\Util\StringHelper;

class Product implements ProductInterface {
    protected $id;
    protected $createdAt;
    protected $name;
    protected $description;
    protected $slug;
    protected $price;
    protected $brand;
    protected $category;
    protected $photos;
    protected $primaryPhoto;

    public function __construct($name = null) {
        if (!is_null($name)) {
            $this->name = $name;
        }
        $this->createdAt = new \DateTime();
        $this->price     = 0;
        $this->photos    = new ArrayCollection();
    }

    public function __toString() {
        return (string) $this->getName();
    }

    public function getId() {
        return $this->id;
    }

    public function setCreatedAt($createdAt) {
        $this->createdAt = $createdAt;
        return $this;
    }

    public function getCreatedAt() {
        return $this->createdAt;
    }

    public function setName($name) {
        $this->name = $name;
        return $this;
    }

    public function getName() {
        return $this->name;
    }

    public function setDescription($description) {
        $this->description = $description;
        return $this;
    }

    public function getDescription() {
        return $this->description;
    }

    public function setSlug($slug) {
        $this->slug = $slug;
        return $this;
    }

    public function getSlug() {
        return $this->slug;
    }

    public function setPrice($price) {
        $this->price = $price;
        return $this;
    }

    public function getPrice() {
        return $this->price;
    }

    public function setBrand(ProductBrandInterface $brand) {
        $this->brand = $brand;
        return $this;
    }

    public function getBrand() {
        return $this->brand;
    }

    public function setCategory(ProductCategoryInterface $category) {
        $this->category = $category;
        return $this;
    }

    public function getCategory() {
        return $this->category;
    }

    public function hasPhoto(ProductPhotoInterface $photo) {
        return $this->photos->contains($photo);
    }

    public function getPhotos() {
        return $this->photos;
    }

    public function addPhoto(ProductPhotoInterface $photo) {
        if (!$this->hasPhoto($photo)) {
            $photo->setProduct($this);
            $this->photos->add($photo);
        }
        return $this;
    }

    public function removePhoto(ProductPhotoInterface $photo) {
        $photo->setProduct(null);
        $this->photos->removeElement($photo);
        return $this;
    }

    public function setPrimaryPhoto(ProductPhotoInterface $photo) {
        $this->primaryPhoto = $photo;
        return $this;
    }

    public function getPrimaryPhoto() {
        return $this->primaryPhoto;
    }

    public function setSlugValue() {
        if ($this->getSlug() === null) {
            $slug = StringHelper::slugify($this->getName());
            $this->setSlug($slug);
        }
    }
}