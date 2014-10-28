<?php

namespace Podorozhny\Manager\Shop;

use Podorozhny\Manager\ObjectManager;

class ProductCategoryManager extends ObjectManager {
    public function findBySlug($slug) {
        return $this->findOneBy(array('slug' => $slug));
    }

    public function findAllParents($limit = null, $offset = null) {
        return $this->getRepository()->findAllParents($limit, $offset);
    }
}