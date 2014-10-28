<?php

namespace Podorozhny\CoreBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Podorozhny\CoreBundle\DataFixtures\DataFixture;

class LoadFrontendUserFixture extends DataFixture {
    public function load(ObjectManager $manager) {
        $userManager = $this->get('podorozhny.frontend.user_manager');

        $user = $userManager->create()
                            ->setEmail('tsar@iu4.ru')
                            ->setPlainPassword('doshiraklapshichka')
                            ->setEnabled(true)
                            ->setFirstname('Вадик')
                            ->setLastname('Шахнов');
        $userManager->updateUser($user);

        for ($i = 0; $i < mt_rand(30, 50); $i++) {
            $enabled = $this->faker->boolean(35);
            $user    = $userManager->create()
                                   ->setEmail($this->faker->email)
                                   ->setPlainPassword($this->faker->password)
                                   ->setEnabled($enabled)
                                   ->setLocked($enabled & $this->faker->boolean(10))
                                   ->setFirstname($this->faker->firstName);
            if ($this->faker->boolean(25)) $user->setLastname($this->faker->lastName);
            $userManager->updateUser($user);
        }
    }

    public function getOrder() {
        return 24;
    }
}