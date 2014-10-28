<?php

namespace Podorozhny\Twig\Extension;

class CompressOutputExtension extends \Twig_Extension {
    public function getFilters() {
        return array(
            new \Twig_SimpleFilter('compress', array($this, 'compressFilter')),
        );
    }

    public function compressFilter($content) {
        $content = str_replace(array("\n", "\r", "\t"), " ", $content);
        $content = preg_replace("/ {2,}/", " ", $content);

        return $content;
    }

    public function getName() {
        return 'compress_output_extension';
    }
}
