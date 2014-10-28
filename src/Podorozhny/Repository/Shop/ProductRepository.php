<?php

namespace Podorozhny\Repository\Shop;

use Podorozhny\Repository\AbstractRepository;

class ProductRepository extends AbstractRepository {
    public function findManyByCategorySlug($category_slug, $limit = null, $offset = null) {
        return $this->getEntityManager()
                    ->createQueryBuilder()
                    ->select('p')
                    ->from('Shop:Product', 'p')
                    ->join('p.category', 'c')
                    ->where('c.slug = :category_slug')
                    ->setParameters(array(
                                        'category_slug' => $category_slug,
                                    ))
                    ->orderBy('p.name', 'ASC')
                    ->setFirstResult($offset)
                    ->setMaxResults($limit)
                    ->getQuery()
                    ->getResult();
    }
}