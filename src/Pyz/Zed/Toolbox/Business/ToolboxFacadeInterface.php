<?php

declare(strict_types=1);

namespace Pyz\Zed\Toolbox\Business;

interface ToolboxFacadeInterface
{
    public function generateBackendApiModule(string $configFilePath): void;

    public function generateBackendApiModuleFromName(string $configFilePath);

    public function generateZedModuleFromConfig(mixed $configFilePath);

    public function generateYvesModuleFromConfig(mixed $configFilePath);

    public function generateClientModuleFromConfig(mixed $configFilePath);

    public function generateFrontendApiModuleFromConfig(mixed $configFilePath);

    public function generateBackendApiModuleFromConfig(mixed $configFilePath);

    public function generateZedModuleFromName(mixed $name);
}
