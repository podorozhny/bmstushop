<?php

namespace Podorozhny\CoreBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Podorozhny\CoreBundle\DataFixtures\DataFixture;

class LoadSupportContactFixture extends DataFixture {
    public function load(ObjectManager $manager) {
        $contactSubjectManager = $this->get('podorozhny.support.contact_subject_manager');
        $contactManager        = $this->get('podorozhny.support.contact_manager');

        $contactSubjects = $contactSubjectManager->findAll();

        for ($i = 0, $count = mt_rand(10, 30); $i < $count; $i++) {
            $contactSubject = $contactSubjects[array_rand($contactSubjects)];

            $contact = $contactManager->create()
//                                      ->setUseragent()
//                                      ->setIp()
                                      ->setEmail($this->faker->email)
                                      ->setSubject($contactSubject)
                                      ->setMessage($this->faker->text($this->faker->numberBetween(20, 500)));
            if ($this->faker->boolean(75)) $contact->setFirstname($this->faker->firstName);
            if ($this->faker->boolean(25)) $contact->setLastname($this->faker->lastName);
            $contactManager->update($contact);
        }
    }

    public function getOrder() {
        return 32;
    }
}