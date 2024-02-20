<?php

declare(strict_types=1);

namespace Pyz\Glue\TestBackendApi;

use Spryker\Glue\Kernel\Backend\AbstractFactory;

 use Pyz\Glue\TestBackendApi\Processor\Mapper\TestMapperInterface;
 use Pyz\Glue\TestBackendApi\Processor\Mapper\TestMapper;
 use Pyz\Glue\TestBackendApi\Processor\Reader\TestReaderInterface;
 use Pyz\Glue\TestBackendApi\Processor\Reader\TestReader;
 use Pyz\Glue\TestBackendApi\Processor\ResponseBuilder\TestResponseBuilderInterface;
 use Pyz\Glue\TestBackendApi\Processor\ResponseBuilder\TestResponseBuilder;

class TestBackendApiFactory extends AbstractFactory
   {

  public function createTestMapper(): TestMapperInterface
  {
      return new TestMapper();
  }


  public function createTestReader(): TestReaderInterface
  {
      return new TestReader();
  }


  public function createTestResponseBuilder(): TestResponseBuilderInterface
  {
      return new TestResponseBuilder();
  }
}
