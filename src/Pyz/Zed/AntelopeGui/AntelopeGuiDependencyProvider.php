<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\AntelopeGui;

use Orm\Zed\Antelope\Persistence\PyzAntelopeQuery;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

/**
 * @method \Pyz\Zed\AntelopeGui\AntelopeGuiConfig getConfig()
 */
class AntelopeGuiDependencyProvider extends AbstractBundleDependencyProvider
{
    public const  FACADE_ANTELOPE = 'FACADE_ANTELOPE';
    public const  FACADE_ANTELOPE_LOCATION = 'FACADE_ANTELOPE_LOCATION';
    public const  FACADE_ANTELOPE_TYPE = 'FACADE_ANTELOPE_TYPE';

    public const PROPEL_QUERY_ANTELOPE = 'PROPEL_QUERY_ANTELOPE';
    public const FACADE_MAIL = 'FACADE_MAIL';

    public function provideCommunicationLayerDependencies(Container $container): Container
    {
        $container = $this->addAntelopeQuery($container);
        $container = $this->addAntelopeFacade($container);
        $container = $this->addAntelopeTypeFacade($container);
        $container = $this->addAntelopeLocationFacade($container);
        return $container;
    }

    protected function addAntelopeQuery(Container $container): Container
    {
        $container->set(static::PROPEL_QUERY_ANTELOPE, $container->factory(fn() => PyzAntelopeQuery::create()));

        return $container;
    }

    protected function addAntelopeFacade(Container $container): Container
    {
        $container->set(static::FACADE_ANTELOPE, fn() => $container->getLocator()->antelope()->facade());
        return $container;
    }

    protected function addAntelopeTypeFacade(Container $container): Container
    {
        $container->set(
            static::FACADE_ANTELOPE_TYPE,
            fn() => $container->getLocator()->antelopeType()->facade()
        );
      
        return $container;
    }

    protected function addAntelopeLocationFacade(Container $container): Container
    {
        $container->set(
            static::FACADE_ANTELOPE_LOCATION,
            fn() => $container->getLocator()->antelopeLocation()->facade()
        );
        return $container;
    }
}
