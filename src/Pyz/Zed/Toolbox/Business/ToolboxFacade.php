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
    public function generateBackendApiModule(string $configFilePath): void
    {
        $this->getFactory()->createModuleGenerator()->generateModuleFromConfig($configFilePath);
    }

    public function generateBackendApiModuleFromName(string $name): void
    {
        $this->getFactory()->createBackendApiModuleGenerator()->generateModuleFromName($name);
    }

    public function generateZedModuleFromConfig(mixed $configFilePath): void
    {
        // TODO: Implement generateZedModuleFromConfig() method.
    }

    public function generateYvesModuleFromConfig(mixed $configFilePath): void
    {
        // TODO: Implement generateYvesModuleFromConfig() method.
    }

    public function generateClientModuleFromConfig(mixed $configFilePath): void
    {
        // TODO: Implement generateClientModuleFromConfig() method.
    }

    public function generateFrontendApiModuleFromConfig(mixed $configFilePath): void
    {
        // TODO: Implement generateFrontendApiModuleFromConfig() method.
    }

    public function generateBackendApiModuleFromConfig(string $configFilePath): void
    {
        $this->getFactory()->createBackendApiModuleGenerator()->generateModuleFromConfig($configFilePath);
    }

    public function generateZedModuleFromName(mixed $name): void
    {
        $this->getFactory()->createZedModuleGenerator()->generateModuleFromName($name);
    }
}
