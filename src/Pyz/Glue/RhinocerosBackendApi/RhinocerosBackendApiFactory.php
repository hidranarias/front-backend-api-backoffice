<?php

declare(strict_types=1);

namespace Pyz\Glue\RhinocerosBackendApi;

use Spryker\Glue\Kernel\Backend\AbstractFactory;

 use Pyz\Glue\RhinocerosBackendApi\Processor\Mapper\RhinocerosMapperInterface;
 use Pyz\Glue\RhinocerosBackendApi\Processor\Mapper\RhinocerosMapper;
 use Pyz\Glue\RhinocerosBackendApi\Processor\Reader\RhinocerosReaderInterface;
 use Pyz\Glue\RhinocerosBackendApi\Processor\Reader\RhinocerosReader;
 use Pyz\Glue\RhinocerosBackendApi\Processor\ResponseBuilder\RhinocerosResponseBuilderInterface;
 use Pyz\Glue\RhinocerosBackendApi\Processor\ResponseBuilder\RhinocerosResponseBuilder;

class RhinocerosBackendApiFactory extends AbstractFactory
   {

  public function createRhinocerosMapper(): RhinocerosMapperInterface
  {
      return new RhinocerosMapper();
  }


  public function createRhinocerosReader(): RhinocerosReaderInterface
  {
      return new RhinocerosReader();
  }


  public function createRhinocerosResponseBuilder(): RhinocerosResponseBuilderInterface
  {
      return new RhinocerosResponseBuilder();
  }
}
