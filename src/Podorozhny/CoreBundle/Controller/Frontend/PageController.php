<?php

namespace Podorozhny\CoreBundle\Controller\Frontend;

use Podorozhny\CoreBundle\Controller\AbstractController;

class PageController extends AbstractController {
    public function aboutAction() {
        return $this->render('CoreBundle:Frontend/Page:about.html.twig');
    }
}