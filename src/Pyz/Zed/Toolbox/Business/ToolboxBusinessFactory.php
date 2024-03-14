<?php

declare(strict_types=1);

namespace Pyz\Zed\Toolbox\Business;

use Pyz\Zed\Toolbox\Business\Writer\BackendApiModuleGenerator;
use Pyz\Zed\Toolbox\Business\Writer\ModuleGeneratorInterface;
use Pyz\Zed\Toolbox\Business\Writer\ZedModuleGenerator;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

class ToolboxBusinessFactory extends AbstractBusinessFactory
{
    public function createBackendApiModuleGenerator(): BackendApiModuleGenerator
    {
        return new BackendApiModuleGenerator();
    }

    public function createZedModuleGenerator(): ModuleGeneratorInterface
    {
        return new ZedModuleGenerator();
    }
// Add methods to provide dependencies to BackendApiModuleGenerator if needed
}
