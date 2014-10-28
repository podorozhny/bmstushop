<?php
/**
 * http://stackoverflow.com/questions/24064813/how-to-split-validation-yaml-files-in-symfony-2-5
 */

namespace Podorozhny\CoreBundle\DependencyInjection\Compiler;

use Symfony\Component\Finder\Finder;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;

class ValidationPass implements CompilerPassInterface {
    public function process(ContainerBuilder $container) {
        $validatorBuilder = $container->getDefinition('validator.builder');
        $validatorFiles   = array();
        $finder           = new Finder();

        foreach ($finder->files()->in(__DIR__ . '/../../Resources/config/validation') as $file) {
            $validatorFiles[] = $file->getRealPath();
        }

        $validatorBuilder->addMethodCall('addYamlMappings', array($validatorFiles));
    }
}