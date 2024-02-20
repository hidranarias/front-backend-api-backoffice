<?php

declare(strict_types=1);

namespace Pyz\Zed\Toolbox\Business;

use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \Pyz\Zed\Toolbox\Business\ToolboxBusinessFactory getFactory()
 */
class ToolboxFacade extends AbstractFacade implements ToolboxFacadeInterface
{
    /**
     * Generate a module based on the provided YAML configuration file.
     *
     * @param string $configFilePath Path to the YAML configuration file.
     * @return void
     */
    public function generateModuleFromConfig(string $configFilePath): void
    {
        $this->getFactory()->createModuleGenerator()->generateModuleFromConfig($configFilePath);
    }

    public function generateModuleFromName(string $name): void
    {
        $this->getFactory()->createModuleGenerator()->generateModuleFromName($name);
    }
}
