<?php

declare(strict_types=1);

namespace Pyz\Glue\HidranBackendApi;

use Spryker\Glue\Kernel\Backend\AbstractFactory;

 use Pyz\Glue\HidranBackendApi\Processor\Mapper\HidranMapperInterface;
 use Pyz\Glue\HidranBackendApi\Processor\Mapper\HidranMapper;
 use Pyz\Glue\HidranBackendApi\Processor\Reader\HidranReaderInterface;
 use Pyz\Glue\HidranBackendApi\Processor\Reader\HidranReader;
 use Pyz\Glue\HidranBackendApi\Processor\ResponseBuilder\HidranResponseBuilderInterface;
 use Pyz\Glue\HidranBackendApi\Processor\ResponseBuilder\HidranResponseBuilder;

class HidranBackendApiFactory extends AbstractFactory
   {

  public function createHidranMapper(): HidranMapperInterface
  {
      return new HidranMapper();
  }


  public function createHidranReader(): HidranReaderInterface
  {
      return new HidranReader();
  }


  public function createHidranResponseBuilder(): HidranResponseBuilderInterface
  {
      return new HidranResponseBuilder();
  }
}
