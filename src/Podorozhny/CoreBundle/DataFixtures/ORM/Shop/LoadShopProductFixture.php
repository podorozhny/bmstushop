<?php

namespace Podorozhny\CoreBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Podorozhny\CoreBundle\DataFixtures\DataFixture;
use Podorozhny\Util\StringHelper;
use Symfony\Component\Finder\Finder;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class LoadShopProductFixture extends DataFixture {
    protected $photos = array();

    public function load(ObjectManager $manager) {
        $productPhotoManager = $this->get('podorozhny.shop.product_photo_manager');
        $uploader = $this->get('podorozhny.image_uploader');

        foreach ((new Finder())->files()->in(__DIR__ . '/../../../../../../app/Resources/fixtures/images/products') as $img) {
            $photo = $productPhotoManager->create();
            $photo->setFile(new UploadedFile($img->getRealPath(), $img->getFilename()));
            $uploader->upload($photo);
            $productSlug = explode('----', $img->getBasename('.jpg'));
            $productSlug = $productSlug[0];
            $this->photos[$productSlug][] = $photo;
            $productPhotoManager->update($photo);
        }

        $this->createProduct('CF-50 (С1-4) 0.5 Вт, 120 Ом, 5%, Резистор углеродистый', 1.20, 'Маломощные резисторы (до 2 Вт)', 'Тайвань', '<p>Резисторы с углеродным проводящим слоем предназначены для работы в цепях постоянного, переменного и импульсного тока.</p><p>Являются заменой отечественных резисторов С1-4</p><p>Номинальная мощность: 0.25 Вт, 0.5 Вт, 1 Вт, 2 Вт</p><p>Диапазон номинальных сопротивлений: 1 Ом - 10 МОм; ряд E24</p><p>Точность: 5% (J)</p><p>Диапазон рабочих температур: -55 …+125°C</p>');
        $this->createProduct('MO-200 (С2-23) 2 Вт, 36 Ом, 5%, Резистор металлооксидный', 3.90, 'Мощные резисторы (от 2 Вт и более)', 'Тайвань', '<p>Металлооксидные (металлодиэлектрические) постоянные резисторы являются аналогами отечественной серии сопротивлений С2-23. Предназначены для работы в цепях постоянного, переменного и импульсного тока.</p>');
        $this->createProduct('16K1-B50K, L15KC, 50 кОм, Резистор переменный', 19, 'Переменные резисторы', 'Song Huei Electronic');
        $this->createProduct('3362P-1-502LF (СП3-19а), 5 кОм, Резистор подстроечный', 43, 'Подстроечные резисторы', 'Bourns', '<p>Основные особенности:</p><p>Металлокерамика</p><p>240°</p><p>Выводные</p><p>0.5 Вт</p>');

        $this->createProduct('Кер.ЧИП конд. 2.2пФ NPO 50В, 5%, 0805', 0.90, 'Керамические конденсаторы', 'Тайвань');
        $this->createProduct('К73-17 имп, 1000 пФ, 630 В, 5-10%, Конденсатор металлоплёночный', 1.50, 'Пленочные конденсаторы', 'Китай');
        $this->createProduct('К78-2, 0.033 мкФ, 1000 В, 10%, Конденсатор металлоплёночный', 13, 'Пленочные конденсаторы', 'Поликонд');
        $this->createProduct('ECAP (К50-35), 470 мкФ, 16 В, 105°C, Конденсатор электролитический алюминиевый', 4.10, 'Электролитические конденсаторы', 'Jamicon');
        $this->createProduct('ECAP (К50-35), 22000 мкФ, 25 В, 105°C, Конденсатор электролитический алюминиевый', 260, 'Электролитические конденсаторы', 'Тайвань');

        $this->createProduct('2N5551, Транзистор NPN 160В 600мА 0.6Вт TO-92', 5.30, 'Биполярные транзисторы', 'Toshiba');
        $this->createProduct('2N5401, Транзистор PNP 150В 600мА 0.6Вт TO-92', 5.70, 'Биполярные транзисторы', 'Fairchild Semiconductor');
        $this->createProduct('IRF840APBF, Nкан 500В 8.0А TO220AB', 41, 'Полевые транзисторы', 'Vishay/IR');

        $this->createProduct('ATmega8-16PU, Микроконтроллер 8-Бит AVR, 16МГц, FLASH-8КБайт, DIP-28', 190, 'Микроконтроллеры', 'Atmel');
        $this->createProduct('ATmega8-16AU, Микроконтроллер 8-Бит AVR, 16МГц, FLASH-8КБайт, TQFP-32', 160, 'Микроконтроллеры', 'Atmel');
        $this->createProduct('STM32F030C8T6, MCU, 32BIT, CORTEX-M0, 48MHZ, LQFP-48', 340, 'Микроконтроллеры', 'ST Microelectronics', '<p>MCU, 32BIT, CORTEX-M0, 48MHZ, LQFP-48</p><p>Semiconductors - ICs\Microcontrollers (MCU)\Microcontrollers (MCU) - 32 Bit</p>');
        $this->createProduct('TLV2542ID, PBF SO8', 550, 'АЦП', 'Texas Instruments');
        $this->createProduct('LM317LZ, 3-х выводной регулятор напряжения с установкой выходного напряжения 1.2В…37В, 0.1А', 10, 'Стабилизаторы напряжения и тока', 'Fairchild Semiconductor');

        $this->createProduct('ТТП-40 (2х18В, 1.0А), Трансформатор тороидальный, 2х18В, 1.0А', 690, 'Силовые трансформаторы', 'Торэл', '<p>Применение тороидальных трансформаторов позволяет уменьшить массу и габариты изделий, повысить КПД, увеличить плотность монтажа.</p><p>Кроме того, тороидальные трансформаторы являются хорошей альтернативой и импульсным источникам питания для систем критичных к высокочастотным помехам, таких как измерительные приборы, в том числе приборы учета тепла, электроэнергии, высококачественные аудио, радиоприемные и передающие устройства.</p>');
        $this->createProduct('ТПП-258-220-50, Трансформатор, 2х5 2x10B 0.88A', 1560, 'Силовые трансформаторы', 'Трансвит', '<p>Линейка трансформаторов питания для печатного монтажа представлена моделями различной мощности с широким спектром напряжений вторичных обмоток. Конструкция каркаса обеспечивает усиленную изоляцию между первичной и вторичной обмотками. Электрическая прочность изоляции: первичная - вторичная 4000 В, вторичная - вторичная 600 В.</p><p>Напряжение питания 220 В ± 10%, частота 50 Гц ± 0,5 Гц.</p><p>Трансформаторы изготавливаются в пожаробезопасном исполнении, класс трудногорючести по UL94 V-0 или V-2. Допустимые отклонение вторичных напряжений ±5%. Имеются модели в герметичном исполнении.</p>');
        $this->createProduct('ТОТ133, Трансформатор', 250, 'Согласующие трансформаторы', 'Россия');
    }

    public function getOrder() {
        return 53;
    }

    protected function createProduct($name, $price = 0, $category, $brand = null, $description = null) {
        $productManager = $this->get('podorozhny.shop.product_manager');

        $product = $productManager->create()
                                  ->setName($name)
                                  ->setPrice($price)
                                  ->setCategory($this->getReference('Podorozhny.Shop.ProductCategory.' . $category));
        if ($description) $product->setDescription($description);
        if ($brand) $product->setBrand($this->getReference('Podorozhny.Shop.ProductBrand.' . $brand));

        $slug = StringHelper::slugify($name);

        for ($i = 0, $count = count($this->photos[$slug]); $i < $count; $i++) {
            if ($i == 0) $product->setPrimaryPhoto($this->photos[$slug][$i]);
            $product->addPhoto($this->photos[$slug][$i]);
        }

        $productManager->update($product);
    }
}