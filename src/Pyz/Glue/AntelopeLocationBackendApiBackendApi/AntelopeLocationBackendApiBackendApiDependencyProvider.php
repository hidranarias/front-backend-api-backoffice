<?php

declare(strict_types=1);

namespace Pyz\Glue\AntelopeLocationBackendApiBackendApi;

use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class AntelopeLocationBackendApiBackendApiDependencyProvider extends AbstractBundleDependencyProvider
{
    public function provideBusinessLayerDependencies(Container $container): Container
    {
        $container = parent::provideBusinessLayerDependencies($container);
        
        return $container;
    }
}