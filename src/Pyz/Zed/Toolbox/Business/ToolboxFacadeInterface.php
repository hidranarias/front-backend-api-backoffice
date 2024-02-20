<?php

declare(strict_types=1);

namespace Pyz\Zed\Toolbox\Business;

interface ToolboxFacadeInterface
{
    public function generateModuleFromConfig(string $configFilePath): void;
}
