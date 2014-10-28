<?php

namespace Podorozhny\CoreBundle\Controller;

use Symfony\Bundle\TwigBundle\Controller\ExceptionController as BaseExceptionController;
use Symfony\Bundle\FrameworkBundle\Templating\TemplateReference;
use Symfony\Component\HttpKernel\Exception\FlattenException;
use Symfony\Component\HttpKernel\Log\DebugLoggerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ExceptionController extends BaseExceptionController {
    protected function findTemplate(Request $request, $format, $code, $debug) {
        if (!$debug) {
            $template = new TemplateReference('CoreBundle', 'Exception', 'error' . $code, $format, 'twig');
            if ($this->templateExists($template)) {
                return $template;
            }
        }

        return parent::findTemplate($request, $format, $code, $debug);
    }
}