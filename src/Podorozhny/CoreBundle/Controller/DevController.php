<?php

namespace Podorozhny\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class DevController extends Controller {
    public function testAction() {
        $content = "I'm using special secret features for debugging app";

        return new Response($content);
    }
}