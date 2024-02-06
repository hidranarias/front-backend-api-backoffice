<?php

namespace Pyz\Glue\AntelopeBackendApi;

use Spryker\Glue\Kernel\Backend\AbstractBundleDependencyProvider;
use Spryker\Glue\Kernel\Backend\Container;

class AntelopeBackendApiDependencyProvider extends AbstractBundleDependencyProvider
{
    public const ANTELOPE_FACADE = 'ANTELOPE_FACADE';

    public function provideBackendDependencies(Container $container): Container
    {
        $container = parent::provideBackendDependencies($container);
        $container = $this->provideAntelopeFacade($container);
        return $container;
    }

    private function provideAntelopeFacade(Container $container): Container
    {
        $container->set(static::ANTELOPE_FACADE, static function (Container $container) {
            return $container->getLocator()->antelope()->facade();
        });
        return $container;
    }
}
