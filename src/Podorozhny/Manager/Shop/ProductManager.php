<?php

namespace Podorozhny\Manager\Shop;

use Podorozhny\Manager\ObjectManager;

class ProductManager extends ObjectManager {
    public function findBySlug($slug) {
        return $this->findOneBy(array('slug' => $slug));
    }

    public function findManyByCategorySlug($category_slug, $limit = null, $offset = null) {
        return $this->getRepository()->findManyByCategorySlug($category_slug, $limit, $offset);
    }
}