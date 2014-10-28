<?php

namespace Podorozhny\CoreBundle\DataFixtures;

#use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Faker\Factory as FakerFactory;
use Faker\Generator;

abstract class DataFixture extends AbstractFixture implements ContainerAwareInterface, OrderedFixtureInterface {
    protected $container;

    protected $faker;

    public function __construct() {
        $this->faker = FakerFactory::create('ru_RU');
        $this->faker->addProvider(new \Faker\Provider\en_US\Address($this->faker));
    }

    public function setContainer(ContainerInterface $container = null) {
        $this->container = $container;
    }

    protected function get($id) {
        return $this->container->get($id);
    }

    /*public function __call($method, $arguments) {
        $matches = array();
        if (preg_match('/^get(.*)Repository$/', $method, $matches)) {
            return $this->get('sylius.repository.' . $matches[1]);
        }

        return call_user_func_array(array($this, $method), $arguments);
    }

    protected function getZoneMemberRepository($zoneType) {
        return $this->get('sylius.repository.zone_member_' . $zoneType);
    }

    protected function getVariantGenerator() {
        return $this->get('sylius.generator.product_variant');
    }

    protected function getZoneByName($name) {
        return $this->getReference('Sylius.Zone.' . $name);
    }*/
}
