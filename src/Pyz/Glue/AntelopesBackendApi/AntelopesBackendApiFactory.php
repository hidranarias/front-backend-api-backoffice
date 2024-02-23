<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Glue\AntelopesBackendApi;

use Pyz\Glue\AntelopesBackendApi\Processor\Creator\AntelopeCreator;
use Pyz\Glue\AntelopesBackendApi\Processor\Creator\AntelopeCreatorInterface;
use Pyz\Glue\AntelopesBackendApi\Processor\Mapper\AntelopeMapper;
use Pyz\Glue\AntelopesBackendApi\Processor\Mapper\AntelopeMapperInterface;
use Pyz\Glue\AntelopesBackendApi\Processor\Reader\AntelopeReader;
use Pyz\Glue\AntelopesBackendApi\Processor\Reader\AntelopeReaderInterface;
use Pyz\Glue\AntelopesBackendApi\Processor\ResponseBuilder\AntelopeResponseBuilder;
use Pyz\Glue\AntelopesBackendApi\Processor\ResponseBuilder\AntelopeResponseBuilderInterface;
use Pyz\Glue\AntelopesBackendApi\Processor\ResponseBuilder\ErrorResponseBuilder;
use Pyz\Glue\AntelopesBackendApi\Processor\Updater\AntelopeUpdater;
use Pyz\Glue\AntelopesBackendApi\Processor\Updater\AntelopeUpdaterInterface;
use Pyz\Zed\Antelope\Business\AntelopeFacadeInterface;
use Spryker\Glue\Kernel\Backend\AbstractFactory;

class AntelopesBackendApiFactory extends AbstractFactory
{

    public function createAntelopesReader(): AntelopeReaderInterface
    {
        return new AntelopeReader($this->getAntelopeFacade(), $this->createAntelopeResponseBuilder());
    }

    public function getAntelopeFacade(): AntelopeFacadeInterface
    {
        return $this->getProvidedDependency(AntelopesBackendApiDependencyProvider::FACADE_ANTELOPE);
    }

    public function createAntelopeResponseBuilder(): AntelopeResponseBuilderInterface
    {
        return new AntelopeResponseBuilder();
    }

    public function createAntelopeWriter(): AntelopeCreatorInterface
    {
        return new AntelopeCreator($this->getAntelopeFacade(), $this->createAntelopeMapper(),
            $this->createAntelopeResponseBuilder());
    }

    public function createAntelopeMapper(): AntelopeMapperInterface
    {
        return new AntelopeMapper();
    }

    public function createAntelopeUpdater(): AntelopeUpdaterInterface
    {
        return new AntelopeUpdater(
            $this->getAntelopeFacade(),
            $this->createAntelopeMapper(),
            $this->createAntelopeResponseBuilder(),
            $this->createErrorResponseBuilder()
        );
    }

    public function createErrorResponseBuilder(): ErrorResponseBuilder
    {
        return new ErrorResponseBuilder($this->getConfig());
    }

}
