<?php

namespace Podorozhny\Model\Shop;

use Podorozhny\Model\Image;

class ProductPhoto extends Image implements ProductPhotoInterface {
    protected $product;

    public function getProduct() {
        return $this->product;
    }

    public function setProduct(ProductInterface $product = null) {
        $this->product = $product;
        return $this;
    }
}