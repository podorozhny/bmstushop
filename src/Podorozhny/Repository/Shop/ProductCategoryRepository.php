<?php

namespace Podorozhny\Repository\Shop;

use Podorozhny\Repository\AbstractRepository;

class ProductCategoryRepository extends AbstractRepository {
    public function findAllParents($limit = null, $offset = null) {
        return $this->getEntityManager()
                    ->createQueryBuilder()
                    ->select('c')
                    ->from('Shop:ProductCategory', 'c')
                    ->where('c.parent IS NULL')
                    ->orderBy('c.name', 'ASC')
                    ->setFirstResult($offset)
                    ->setMaxResults($limit)
                    ->getQuery()
                    ->getResult();
    }
}