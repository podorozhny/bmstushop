<?php

namespace Podorozhny\CoreBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Podorozhny\CoreBundle\DataFixtures\DataFixture;

class LoadShopProductCategoryFixture extends DataFixture {
    public function load(ObjectManager $manager) {
        $this->createCategory('Резисторы', 'resistors');
        $this->createCategory('Маломощные резисторы (до 2 Вт)', 'low-resistors', 'Резисторы');
        $this->createCategory('Мощные резисторы (от 2 Вт и более)', 'high-resistors', 'Резисторы');
        $this->createCategory('Переменные резисторы', 'potentiometers', 'Резисторы');
        $this->createCategory('Подстроечные резисторы', 'trimmer-resistors', 'Резисторы');

        $this->createCategory('Конденсаторы', 'capacitors');
        $this->createCategory('Керамические конденсаторы', 'ceramic-capacitors', 'Конденсаторы');
        $this->createCategory('Пленочные конденсаторы', 'film-capacitors', 'Конденсаторы');
        $this->createCategory('Электролитические конденсаторы', 'electrolytic-capacitors', 'Конденсаторы');

        $this->createCategory('Транзисторы', 'transistors');
        $this->createCategory('Биполярные транзисторы', 'bipolar-transistors', 'Транзисторы');
        $this->createCategory('Полевые транзисторы', 'field-effect-transistors', 'Транзисторы');

        $this->createCategory('Микросхемы', 'ic');
        $this->createCategory('Микроконтроллеры', 'ic-microcontrollers', 'Микросхемы');
        $this->createCategory('АЦП', 'ic-adc', 'Микросхемы');
        $this->createCategory('Стабилизаторы напряжения и тока', 'ic-stabilizers', 'Микросхемы');

        $this->createCategory('Трансформаторы', 'transformers');
        $this->createCategory('Силовые трансформаторы', 'power-transformers', 'Трансформаторы');
        $this->createCategory('Согласующие трансформаторы', 'matching-transformers', 'Трансформаторы');
    }

    public function getOrder() {
        return 52;
    }

    protected function createCategory($name, $slug, $parent = null) {
        $productCategoryManager = $this->get('podorozhny.shop.product_category_manager');

        $category = $productCategoryManager->create()->setName($name);
        if ($slug) {
            $category->setSlug($slug);
        }
        if ($parent) {
            $category->setParent($this->getReference('Podorozhny.Shop.ProductCategory.' . $parent));
        }
        $this->setReference('Podorozhny.Shop.ProductCategory.' . $name, $category);
        $productCategoryManager->update($category);
    }

}