<?php

namespace Podorozhny\CoreBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Podorozhny\CoreBundle\DependencyInjection\CoreExtension;
use Podorozhny\CoreBundle\DependencyInjection\Compiler\ValidationPass;

class CoreBundle extends Bundle {
    public function getContainerExtension() {
        return new CoreExtension();
    }

    public function build(ContainerBuilder $container) {
        parent::build($container);

        $container->addCompilerPass(new ValidationPass());
    }
}