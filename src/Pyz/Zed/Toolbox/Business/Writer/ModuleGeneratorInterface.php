<?php

namespace Pyz\Zed\Toolbox\Business\Writer;

interface ModuleGeneratorInterface
{
    public function generateModuleFromName(string $name): void;

    public function generateModuleFromConfig(string $configFilePath = '', string $content = ''): void;

    /**
     * @param string $content
     * @param string $configFilePath
     * @return mixed
     */
    public function getConfig(string $content, string $configFilePath): mixed;
}
