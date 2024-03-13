<?php

declare(strict_types=1);

namespace Pyz\Glue\AntelopeLocationBackendApiBackendApi;

use Spryker\Glue\Kernel\Backend\AbstractFactory;

 use Pyz\Glue\AntelopeLocationBackendApiBackendApi\Processor\Mapper\AntelopeLocationBackendApiMapperInterface;
 use Pyz\Glue\AntelopeLocationBackendApiBackendApi\Processor\Mapper\AntelopeLocationBackendApiMapper;
 use Pyz\Glue\AntelopeLocationBackendApiBackendApi\Processor\Reader\AntelopeLocationBackendApiReaderInterface;
 use Pyz\Glue\AntelopeLocationBackendApiBackendApi\Processor\Reader\AntelopeLocationBackendApiReader;
 use Pyz\Glue\AntelopeLocationBackendApiBackendApi\Processor\ResponseBuilder\AntelopeLocationBackendApiResponseBuilderInterface;
 use Pyz\Glue\AntelopeLocationBackendApiBackendApi\Processor\ResponseBuilder\AntelopeLocationBackendApiResponseBuilder;

class AntelopeLocationBackendApiBackendApiFactory extends AbstractFactory
   {

  public function createAntelopeLocationBackendApiMapper(): AntelopeLocationBackendApiMapperInterface
  {
      return new AntelopeLocationBackendApiMapper();
  }


  public function createAntelopeLocationBackendApiReader(): AntelopeLocationBackendApiReaderInterface
  {
      return new AntelopeLocationBackendApiReader();
  }


  public function createAntelopeLocationBackendApiResponseBuilder(): AntelopeLocationBackendApiResponseBuilderInterface
  {
      return new AntelopeLocationBackendApiResponseBuilder();
  }
}
