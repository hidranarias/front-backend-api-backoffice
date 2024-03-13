<?php

declare(strict_types=1);

namespace Pyz\Glue\AntelopeTypeBackendApi;

use Spryker\Glue\Kernel\Backend\AbstractFactory;

 use Pyz\Glue\AntelopeTypeBackendApi\Processor\Mapper\AntelopeTypeMapperInterface;
 use Pyz\Glue\AntelopeTypeBackendApi\Processor\Mapper\AntelopeTypeMapper;
 use Pyz\Glue\AntelopeTypeBackendApi\Processor\Reader\AntelopeTypeReaderInterface;
 use Pyz\Glue\AntelopeTypeBackendApi\Processor\Reader\AntelopeTypeReader;
 use Pyz\Glue\AntelopeTypeBackendApi\Processor\ResponseBuilder\AntelopeTypeResponseBuilderInterface;
 use Pyz\Glue\AntelopeTypeBackendApi\Processor\ResponseBuilder\AntelopeTypeResponseBuilder;

class AntelopeTypeBackendApiFactory extends AbstractFactory
   {

  public function createAntelopeTypeMapper(): AntelopeTypeMapperInterface
  {
      return new AntelopeTypeMapper();
  }


  public function createAntelopeTypeReader(): AntelopeTypeReaderInterface
  {
      return new AntelopeTypeReader();
  }


  public function createAntelopeTypeResponseBuilder(): AntelopeTypeResponseBuilderInterface
  {
      return new AntelopeTypeResponseBuilder();
  }
}
