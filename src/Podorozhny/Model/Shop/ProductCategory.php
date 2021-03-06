<?php

namespace Podorozhny\Model\Shop;

use Podorozhny\Util\StringHelper;
use Doctrine\Common\Collections\ArrayCollection;

class ProductCategory implements ProductCategoryInterface {
    protected $id;
    protected $createdAt;
    protected $name;
    protected $slug;
    protected $parent;
    protected $childs;
    protected $products;

    public function __construct($name = null) {
        if (!is_null($name)) {
            $this->name = $name;
        }
        $this->createdAt = new \DateTime();
        $this->products  = new ArrayCollection();
        $this->childs    = new ArrayCollection();
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

    public function setSlug($slug) {
        $this->slug = $slug;
        return $this;
    }

    public function getSlug() {
        return $this->slug;
    }

    public function setParent(ProductCategoryInterface $category) {
        $this->parent = $category;
        return $this;
    }

    public function getParent() {
        return $this->parent;
    }

    public function getChilds() {
        return $this->childs;
    }

    public function getProducts() {
        return $this->products;
    }

    public function getChildsProductsCount() {
        $count = 0;
        foreach ($this->getChilds() as $child) {
            $count += count($child->getProducts());
        }
        return $count;
    }

    public function setSlugValue() {
        if ($this->getSlug() === null) {
            $slug = StringHelper::slugify($this->getName());
            $this->setSlug($slug);
        }
    }
}