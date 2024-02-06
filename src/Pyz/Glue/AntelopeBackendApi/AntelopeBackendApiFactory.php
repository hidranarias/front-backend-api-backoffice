<?php

namespace Pyz\Glue\AntelopeBackendApi;

use Pyz\Zed\Antelope\Business\AntelopeFacadeInterface;
use Spryker\Glue\Kernel\Backend\AbstractBackendApiFactory;

class AntelopeBackendApiFactory extends AbstractBackendApiFactory
{
    public function getAntelopeFacade(): AntelopeFacadeInterface
    {
        return $this->getProvidedDependency(AntelopeBackendApiDependencyProvider::ANTELOPE_FACADE);
    }
}
