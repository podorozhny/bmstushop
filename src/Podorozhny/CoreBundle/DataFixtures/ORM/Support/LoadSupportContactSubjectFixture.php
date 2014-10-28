<?php

namespace Podorozhny\CoreBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Podorozhny\CoreBundle\DataFixtures\DataFixture;

class LoadSupportContactSubjectFixture extends DataFixture {
    public function load(ObjectManager $manager) {
        $contactSubjectManager = $this->get('podorozhny.support.contact_subject_manager');

        $contactSubjectNames = [
            "Общие вопросы",
            "Ошибка в работе сайта",
            "Блокировка аккаунта",
            "Предложение сотрудничества"
        ];

        foreach ($contactSubjectNames as $contactSubjectName) {
            $contactSubject = $contactSubjectManager->create()->setName($contactSubjectName);
            $this->setReference('Podorozhny.Support.Subject.' . $contactSubjectName, $contactSubject);
            $contactSubjectManager->update($contactSubject);
        }
    }

    public function getOrder() {
        return 31;
    }
}