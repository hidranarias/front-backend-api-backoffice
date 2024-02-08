<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Pyz\Zed\Antelope;

use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

/**
 * @method \Pyz\Zed\Antelope\AntelopeConfig getConfig()
 */
class AntelopeDependencyProvider extends AbstractBundleDependencyProvider
{
    public const FACADE_ANTELOPE_LOCATION = 'FACADE_ANTELOPE_LOCATION';
    public const FACADE_ANTELOPE_TYPE = 'FACADE_ANTELOPE_TYPE';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideCommunicationLayerDependencies(Container $container): Container
    {
        $container = parent::provideCommunicationLayerDependencies($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container): Container
    {
        $container = parent::provideBusinessLayerDependencies($container);
        $container = $this->addAntelopeLocationFacade($container);
        $container = $this->addAntelopeTypeFacade($container);
        return $container;
    }

    private function addAntelopeLocationFacade(Container $container)
    {
        $container->set(
            static::FACADE_ANTELOPE_LOCATION,
            fn() => $container->getLocator()->antelopeLocation()->facade()
        );
        return $container;
    }

    private function addAntelopeTypeFacade($container)
    {
        $container->set(
            static::FACADE_ANTELOPE_TYPE,
            fn() => $container->getLocator()->antelopeType()->facade()
        );
        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function providePersistenceLayerDependencies(Container $container): Container
    {
        $container = parent::providePersistenceLayerDependencies($container);

        return $container;
    }
}
