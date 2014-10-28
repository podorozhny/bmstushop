<?php

namespace Podorozhny\CoreBundle\Event\Frontend;

final class UserEvents {
    const REGISTRATION_INITIALIZE = 'user.registration.initialize';
    const REGISTRATION_SUCCESS = 'user.registration.success';
    const REGISTRATION_COMPLETED = 'user.registration.completed';
    const REGISTRATION_CONFIRM = 'user.registration.confirm';
    const REGISTRATION_CONFIRMED = 'user.registration.confirmed';
    const SECURITY_IMPLICIT_LOGIN = 'user.security.implicit_login';
}