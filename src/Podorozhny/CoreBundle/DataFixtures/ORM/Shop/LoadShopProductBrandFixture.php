<?php

namespace Podorozhny\CoreBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Podorozhny\CoreBundle\DataFixtures\DataFixture;

class LoadShopProductBrandFixture extends DataFixture {
    public function load(ObjectManager $manager) {
        $this->createBrand('Тайвань');
        $this->createBrand('Song Huei Electronic');
        $this->createBrand('Bourns');
        $this->createBrand('Китай');
        $this->createBrand('Поликонд');
        $this->createBrand('Jamicon');
        $this->createBrand('Toshiba');
        $this->createBrand('Fairchild Semiconductor');
        $this->createBrand('Vishay/IR');
        $this->createBrand('Atmel');
        $this->createBrand('ST Microelectronics');
        $this->createBrand('Texas Instruments');
        $this->createBrand('Торэл');
        $this->createBrand('Трансвит');
        $this->createBrand('Россия');
    }

    public function getOrder() {
        return 51;
    }

    protected function createBrand($name, $slug = null) {
        $productBrandManager = $this->get('podorozhny.shop.product_brand_manager');

        $brand = $productBrandManager->create()->setName($name);
        if ($slug) {
            $brand->setSlug($slug);
        }
        $this->setReference('Podorozhny.Shop.ProductBrand.' . $name, $brand);
        $productBrandManager->update($brand);
    }
}