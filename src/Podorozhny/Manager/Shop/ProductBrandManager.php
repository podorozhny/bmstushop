<?php

namespace Podorozhny\Manager\Shop;

use Podorozhny\Manager\ObjectManager;

class ProductBrandManager extends ObjectManager {
    public function findBySlug($slug) {
        return $this->findOneBy(array('slug' => $slug));
    }
}