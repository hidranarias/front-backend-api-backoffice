<?php

declare(strict_types=1);

namespace Pyz\Glue\AntelopeTypesBackendApi;

use Spryker\Glue\Kernel\Backend\AbstractFactory;

 use Pyz\Glue\AntelopeTypesBackendApi\Processor\Mapper\AntelopeTypeMapperInterface;
 use Pyz\Glue\AntelopeTypesBackendApi\Processor\Mapper\AntelopeTypeMapper;
 use Pyz\Glue\AntelopeTypesBackendApi\Processor\Reader\AntelopeTypeReaderInterface;
 use Pyz\Glue\AntelopeTypesBackendApi\Processor\Reader\AntelopeTypeReader;
 use Pyz\Glue\AntelopeTypesBackendApi\Processor\ResponseBuilder\AntelopeTypeResponseBuilderInterface;
 use Pyz\Glue\AntelopeTypesBackendApi\Processor\ResponseBuilder\AntelopeTypeResponseBuilder;

class AntelopeTypesBackendApiFactory extends AbstractFactory
   {

  public function createAntelopeTypeMapper(): AntelopeTypeMapperInterface
  {
      return new AntelopeTypeMapper();
  }


  public function createAntelopeTypesReader(): AntelopeTypeReaderInterface
  {
      return new AntelopeTypeReader();
  }


  public function createAntelopeTypeResponseBuilder(): AntelopeTypeResponseBuilderInterface
  {
      return new AntelopeTypeResponseBuilder();
  }
}
