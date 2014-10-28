<?php

namespace Podorozhny\Model\Shop;

use Podorozhny\Model\ImageInterface;

interface ProductPhotoInterface extends ImageInterface {
    public function getProduct();

    public function setProduct(ProductInterface $product = null);
}