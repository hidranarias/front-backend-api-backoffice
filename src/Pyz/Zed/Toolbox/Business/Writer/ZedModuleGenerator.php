<?php

declare(strict_types=1);

namespace Pyz\Zed\Toolbox\Business\Writer;

use InvalidArgumentException;
use RuntimeException;
use Symfony\Component\Yaml\Yaml;

class ZedModuleGenerator
{
    public function generateModuleFromConfig(string $configFilePath): void
    {
        if (!file_exists($configFilePath)) {
            throw new RuntimeException(sprintf('The configuration file "%s" does not exist.', $configFilePath));
        }

        $config = Yaml::parseFile($configFilePath);
        $this->validateConfig($config);

        $moduleName = $config['module']['name'];
        $moduleNamespace = $config['module']['namespace'];
        $moduleBasePath = $this->createModuleBasePath($moduleNamespace, $moduleName);

        // Ensure the base module directories are created
        $this->generateModuleDirectories($moduleBasePath);

        // Generate the Config file
        $this->generateConfigFile($moduleBasePath, $moduleNamespace, $moduleName);
        $config = Yaml::parseFile($configFilePath)['module'];

        // Generate the Business Factory
        if (isset($config['factory'])) {
            $this->generateFactoryFile($moduleBasePath, $moduleNamespace, $moduleName, $config);
        }

        // Generate the Facade and its interface
        $this->generateFacadeFile($moduleBasePath, $moduleNamespace, $moduleName);

        // Generate Controllers if they are specified

        if (isset($config['controllers'])) {
            $this->generateControllers($moduleBasePath, $moduleNamespace, $moduleName, $config);
        }

        // Generate Plugins if they are specified
        if (isset($config['plugins'])) {
            $this->generatePlugins($moduleBasePath, $moduleNamespace, $moduleName, $config);
        }

        // Generate Transfer Objects if they are specified
        if (isset($config['transfers'])) {
            $this->generateTransferObjects($moduleBasePath, $config);
        }
    }

    /**
     * Validates the parsed YAML configuration.
     *
     * Ensures that all required sections and attributes are present.
     *
     * @param array $config Parsed YAML configuration.
     * @throws InvalidArgumentException If the configuration is invalid or missing required sections.
     */
    protected function validateConfig(array $config): void
    {
        $requiredSections = ['name', 'namespace', 'correspondingZedModule'];
        foreach ($requiredSections as $section) {
            if (empty($config['module'][$section])) {
                throw new InvalidArgumentException("Missing required module section: $section");
            }
        }
        // Optionally, add more specific validations here based on your module requirements.
    }

    /**
     * Creates the base path for the module based on its namespace and name.
     *
     * @param string $moduleNamespace The namespace of the module.
     * @param string $moduleName The name of the module.
     * @return string The base path for the module.
     */
    protected function createModuleBasePath(string $moduleNamespace, string $moduleName): string
    {
        return sprintf('%s/src/%s/%s', getcwd(), str_replace('\\', '/', $moduleNamespace), $moduleName);
    }

    /**
     * Generate necessary module directories.
     *
     * @param string $moduleBasePath The base path where the module directories should be created.
     */
    protected function generateModuleDirectories(string $moduleBasePath): void
    {
        $directories = [
            $moduleBasePath,

        ];

        foreach ($directories as $directory) {
            if (!is_dir($directory) && !mkdir($directory, 0777, true) && !is_dir($directory)) {
                throw new RuntimeException(sprintf('Directory "%s" was not created', $directory));
            }
        }
    }

    /**
     * Generate the Config file for the module.
     *
     * @param string $moduleBasePath The base path for the module.
     * @param string $moduleNamespace The namespace of the module.
     * @param string $moduleName The name of the module.
     */
    protected function generateConfigFile(string $moduleBasePath, string $moduleNamespace, string $moduleName): void
    {
        $configFilePath = sprintf('%s/%sConfig.php', $moduleBasePath, $moduleName);
        $namespace = "{$moduleNamespace}\\Config";

        $configFileContent = <<<PHP
    <?php

    declare(strict_types=1);

    namespace $namespace;

    use Spryker\Glue\Kernel\AbstractBundleConfig;

    class {$moduleName}Config extends AbstractBundleConfig
    {
        // Define configuration constants and methods here.
    }
    PHP;

        if (!file_put_contents($configFilePath, $configFileContent)) {
            throw new RuntimeException("Failed to create config file at: $configFilePath");
        }
    }

    /**
     * Generate the Factory file for the module.
     *
     * @param string $moduleBasePath The base path for the module.
     * @param string $moduleNamespace The namespace of the module.
     * @param string $moduleName The name of the module.
     * @param array $config The parsed YAML configuration for the module.
     */
    protected function generateFactoryFile(
        string $moduleBasePath,
        string $moduleNamespace,
        string $moduleName,
        array $config
    ): void {
        $factoryFilePath = sprintf('%s/%sBusinessFactory.php', $moduleBasePath, $moduleName);
        $namespace = "{$moduleNamespace}\\Business";

        // Start building the content of the factory file
        $factoryFileContent = <<<PHP
    <?php

    declare(strict_types=1);

    namespace $namespace;

    use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

    class {$moduleName}BusinessFactory extends AbstractBusinessFactory
    {
PHP;

        // Dynamically add methods for each service defined in the YAML config
        if (isset($config['factory']['services'])) {
            foreach ($config['factory']['services'] as $service) {
                $serviceName = $service['name'];
                $serviceInterface = $service['interface'];
                $factoryFileContent .= <<<PHP

        /**
         * @return \\$serviceInterface
         */
        public function create$serviceName(): $serviceInterface
        {
            return new {$service['class']}();
        }

PHP;
            }
        }

        // Close the class definition
        $factoryFileContent .= "}\n";

        // Write the factory file to disk
        if (!file_put_contents($factoryFilePath, $factoryFileContent)) {
            throw new RuntimeException("Failed to create factory file at: $factoryFilePath");
        }
    }

    /**
     * Generate the Facade file for the module.
     *
     * @param string $moduleBasePath The base path for the module.
     * @param string $moduleNamespace The namespace of the module.
     * @param string $moduleName The name of the module.
     */
    protected function generateFacadeFile(string $moduleBasePath, string $moduleNamespace, string $moduleName): void
    {
        $facadeFilePath = sprintf('%s/Business/%sFacade.php', $moduleBasePath, $moduleName);
        $namespace = "{$moduleNamespace}\\Business";

        $facadeFileContent = <<<PHP
    <?php

    declare(strict_types=1);

    namespace $namespace;

    use Spryker\Zed\Kernel\Business\AbstractFacade;

    /**
     * @method \\{$moduleNamespace}\\Business\\{$moduleName}BusinessFactory getFactory()
     */
    class {$moduleName}Facade extends AbstractFacade implements {$moduleName}FacadeInterface
    {
        // Define business methods here.
    }
    PHP;

        // Ensure the corresponding interface exists or is also generated
        $interfaceContent = <<<PHP
    <?php

    declare(strict_types=1);

    namespace $namespace;

    interface {$moduleName}FacadeInterface
    {
        // Define interface methods here.
    }
    PHP;

        if (!file_put_contents($facadeFilePath, $facadeFileContent)) {
            throw new RuntimeException("Failed to create facade file at: $facadeFilePath");
        }

        $interfaceFilePath = sprintf('%s/Business/%sFacadeInterface.php', $moduleBasePath, $moduleName);
        if (!file_put_contents($interfaceFilePath, $interfaceContent)) {
            throw new RuntimeException("Failed to create facade interface file at: $interfaceFilePath");
        }
    }

    /**
     * Generate controller files for the module.
     *
     * @param string $moduleBasePath The base path for the module.
     * @param string $moduleNamespace The namespace of the module.
     * @param string $moduleName The name of the module.
     * @param array $config The parsed YAML configuration for the module.
     */
    protected function generateControllers(
        string $moduleBasePath,
        string $moduleNamespace,
        string $moduleName,
        array $config
    ): void {
        if (!isset($config['controllers'])) {
            return; // No controllers to generate.
        }

        foreach ($config['controllers'] as $controller) {
            $controllerName = $controller['name'];
            $controllerPath = sprintf('%s/Controller/%s.php', $moduleBasePath, $controllerName);
            $namespace = "{$moduleNamespace}\\Controller";

            $actionsCode = '';
            foreach ($controller['actions'] as $action) {
                $requestType = $action['request'] ?? 'GlueRequestTransfer';
                $responseType = $action['response'] ?? 'GlueResponseTransfer';
                $actionsCode .= <<<PHP

    /**
     * @param \\Generated\\Shared\\Transfer\\{$requestType} \$requestTransfer
     * @return \\Generated\\Shared\\Transfer\\{$responseType}
     */
    public function {$action['name']}($requestType \$requestTransfer): $responseType
    {
        // TODO: Implement action logic.
    }

PHP;
            }

            $controllerFileContent = <<<PHP
        <?php
        declare(strict_types=1);

        namespace $namespace;

        use Spryker\Glue\Kernel\Backend\Controller\AbstractController;
        use Generated\Shared\Transfer\GlueRequestTransfer;
        use Generated\Shared\Transfer\GlueResponseTransfer;

        class {$controllerName} extends AbstractController
        {{$actionsCode}
        }
        PHP;

            if (!file_put_contents($controllerPath, $controllerFileContent)) {
                throw new RuntimeException("Failed to create controller file at: $controllerPath");
            }
        }
    }

    /**
     * Generate plugin files for the module based on the YAML configuration.
     *
     * @param string $moduleBasePath The base path for the module.
     * @param string $moduleNamespace The namespace of the module.
     * @param string $moduleName The name of the module.
     * @param array $config The parsed YAML configuration for the module.
     */
    protected function generatePlugins(
        string $moduleBasePath,
        string $moduleNamespace,
        string $moduleName,
        array $config
    ): void {
        if (!isset($config['plugins'])) {
            return; // No plugins to generate.
        }

        foreach ($config['plugins'] as $pluginType => $plugins) {
            foreach ($plugins as $plugin) {
                $pluginClassName = $plugin['name'];
                $pluginPath = sprintf('%s/Plugin/%s/%s.php', $moduleBasePath, $pluginType, $pluginClassName);
                $namespace = "{$moduleNamespace}\\Plugin\\{$pluginType}";

                // Ensure the directory exists
                $pluginDirectory = dirname($pluginPath);
                if (!is_dir($pluginDirectory) && !mkdir($pluginDirectory, 0777, true) && !is_dir($pluginDirectory)) {
                    throw new RuntimeException(sprintf('Directory "%s" was not created', $pluginDirectory));
                }

                $pluginInterface = $plugin['interface'] ?? 'PluginInterface'; // Default or specified interface
                $pluginMethods = $this->generatePluginMethods($plugin);

                $pluginFileContent = <<<PHP
            <?php

            declare(strict_types=1);

            namespace $namespace;

            use $pluginInterface;

            class $pluginClassName implements $pluginInterface
            {
                $pluginMethods
            }
            PHP;

                if (!file_put_contents($pluginPath, $pluginFileContent)) {
                    throw new RuntimeException("Failed to create plugin file at: $pluginPath");
                }
            }
        }
    }

    /**
     * Generate method stubs for the plugin based on the configuration.
     *
     * @param array $plugin The plugin configuration.
     * @return string The generated method stubs.
     */
    protected function generatePluginMethods(array $plugin): string
    {
        $methods = '';

        // Assuming methods are defined in the config. Adjust as per your actual config structure.
        foreach ($plugin['methods'] as $method) {
            $methodName = $method['name'];
            $methodReturnType = $method['returnType'] ?? 'void'; // Default return type or specified
            $methods .= <<<METHOD

        /**
         * @return $methodReturnType
         */
        public function $methodName(): $methodReturnType
        {
            // TODO: Implement $methodName.
        }

        METHOD;
        }

        return $methods;
    }

    /**
     * Generate the transfer XML file for the module's transfer objects.
     *
     * @param string $moduleBasePath The base path for the module.
     * @param array $config The parsed YAML configuration for the module.
     */
    protected function generateTransferObjects(string $moduleBasePath, array $config): void
    {
        $transferXmlPath = sprintf('%s/Shared/%s/Transfer/antelopes_backend_api.transfer.xml', $moduleBasePath,
            $config['name']);

        // Ensure the directory for the transfer XML exists
        $transferXmlDirectory = dirname($transferXmlPath);
        if (!is_dir($transferXmlDirectory) && !mkdir($transferXmlDirectory, 0777,
                true) && !is_dir($transferXmlDirectory)) {
            throw new RuntimeException(sprintf('Directory "%s" was not created', $transferXmlDirectory));
        }

        $transfersContent = "<?xml version=\"1.0\"?>\n<transfers>\n";

        foreach ($config['transfers'] as $transfer) {
            $transfersContent .= "    <transfer name=\"{$transfer['name']}\"";

            if (isset($transfer['strict'])) {
                $transfersContent .= " strict=\"{$transfer['strict']}\"";
            }

            $transfersContent .= ">\n";

            foreach ($transfer['properties'] as $property) {
                $transfersContent .= "        <property name=\"{$property['name']}\" type=\"{$property['type']}\"/>\n";
            }

            $transfersContent .= "    </transfer>\n";
        }

        $transfersContent .= '</transfers>';

        if (!file_put_contents($transferXmlPath, $transfersContent)) {
            throw new RuntimeException("Failed to create transfer XML file at: $transferXmlPath");
        }
    }

}
