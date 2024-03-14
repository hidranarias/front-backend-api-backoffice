<?php

declare(strict_types=1);

namespace Pyz\Zed\Toolbox\Business;

interface ToolboxFacadeInterface
{
    public function generateBackendApiModule(string $configFilePath): void;

    public function generateBackendApiModuleFromName(string $configFilePath);

    public function generateZedModuleFromConfig(string $configFilePath);

    public function generateYvesModuleFromConfig(string $configFilePath);

    public function generateClientModuleFromConfig(string $configFilePath);

    public function generateFrontendApiModuleFromConfig(string $configFilePath);

    public function generateBackendApiModuleFromConfig(string $configFilePath);

    public function generateZedModuleFromName(string $name);
}
