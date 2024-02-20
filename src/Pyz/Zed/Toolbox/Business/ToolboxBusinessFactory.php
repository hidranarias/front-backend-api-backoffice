<?php

declare(strict_types=1);

namespace Pyz\Zed\Toolbox\Business;

use Pyz\Zed\Toolbox\Business\Writer\BackendApiModuleGenerator;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

class ToolboxBusinessFactory extends AbstractBusinessFactory
{
    public function createModuleGenerator(): BackendApiModuleGenerator
    {
        return new BackendApiModuleGenerator();
    }

// Add methods to provide dependencies to BackendApiModuleGenerator if needed
}
