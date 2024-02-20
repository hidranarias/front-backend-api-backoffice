<?php

declare(strict_types=1);

namespace Pyz\Zed\Toolbox\Business\Writer;

use InvalidArgumentException;
use RuntimeException;
use Symfony\Component\Yaml\Yaml;

class BackendApiModuleGenerator
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
        $config = $config['module'];

        // Generate the Config file
        $this->generateConfigFile($moduleBasePath, $moduleNamespace, $moduleName, $config);
        $this->generateDependencyProvider($moduleBasePath, $moduleNamespace, $moduleName, $config);
        $this->generateProcessors($moduleBasePath, $moduleNamespace, $config);
        $this->generateFactoryFile($moduleBasePath, $moduleNamespace, $moduleName, $config);

        // Generate the Business Factory
        if (isset($config['factory'])) {
            $this->generateFactoryFile($moduleBasePath, $moduleNamespace, $moduleName, $config);
        }


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
            $this->generateTransferObjects($moduleBasePath, $moduleName, $config['transfers']);
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
        return sprintf('%s/src/%s', getcwd(), str_replace('\\', '/', $moduleNamespace));
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
            $moduleBasePath . '/Controller',

        ];

        foreach ($directories as $directory) {
            if (!is_dir($directory) && !mkdir($directory, 0777, true) && !is_dir($directory)) {
                throw new RuntimeException(sprintf('Directory "%s" was not created', $directory));
            }
        }
    }

    protected function generateConfigFile(
        string $moduleBasePath,
        string $moduleNamespace,
        string $moduleName,
        array $config
    ): void {
        $configClassPath = sprintf('%s/%sConfig.php', $moduleBasePath, $moduleName);
        $namespace = $moduleNamespace;

        $constantsCode = '';
        foreach ($config['config']['constants'] as $constant) {
            $constantsCode .= "    public const {$constant['name']} = '{$constant['value']}';\n";
        }

        $configFileContent = <<<PHP
<?php
declare(strict_types=1);

    namespace $namespace;

    use Spryker\Glue\Kernel\AbstractBundleConfig;

    class {$moduleName}Config extends AbstractBundleConfig
    {
   $constantsCode
    }
PHP;

        file_put_contents($configClassPath, $configFileContent);
    }

    protected function generateDependencyProvider(
        string $moduleBasePath,
        string $moduleNamespace,
        string $moduleName,
        array $config
    ): void {
        $dependencyProviderPath = sprintf('%s/%sDependencyProvider.php', $moduleBasePath, $moduleName);
        $namespace = $moduleNamespace;

        // Dynamic generation for facades and other dependencies can be added here
        $dependencyMethods = '';

        $dependencyProviderContent = <<<PHP
    <?php

    declare(strict_types=1);

    namespace $namespace;

    use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
    use Spryker\Zed\Kernel\Container;

    class {$moduleName}DependencyProvider extends AbstractBundleDependencyProvider
    {
        public function provideBusinessLayerDependencies(Container \$container): Container
        {
            \$container = parent::provideBusinessLayerDependencies(\$container);
            $dependencyMethods
            return \$container;
        }
    }
    PHP;

        file_put_contents($dependencyProviderPath, $dependencyProviderContent);
    }

    protected function generateProcessors(string $moduleBasePath, string $moduleNamespace, array $config): void
    {
        $processorPath = sprintf('%s/Processor', $moduleBasePath);

        if (!is_dir($processorPath) && !mkdir($processorPath, 0777, true) && !is_dir($processorPath)) {
            throw new \RuntimeException(sprintf('Directory "%s" was not created', $processorPath));
        }

        foreach ($config['factory']['services'] as $service) {
            $processorClassName = $service['class'];
            $folder = $service['folder'] ?? '';
            $namespace = $moduleNamespace . '\\Processor';
            if ($folder) {
                $namespace .= '\\' . $folder;
                $this->generateDir($processorPath, $folder);
                $folder = '/' . $folder;
            }
            $processorInterfaceName = $service['interface'];
            $processorInterfaceFilePath = $processorPath . $folder . '/' . $processorInterfaceName . '.php';
            $processorFilePath = $processorPath . $folder . '/' . $processorClassName . '.php';
            $serviceMethods = $service['methods'] ?? [];
            $methods = $interfaceMethods = '';
            if ($serviceMethods) {
                $methods = $this->generateMethods();
                $interfaceMethods = $this->generateInterfaceMethods($serviceMethods);
            }
            // Generate Processor Interface
            $interfaceContent = <<<PHP
        <?php

        declare(strict_types=1);

        namespace $namespace;

        interface $processorInterfaceName
        {
            $interfaceMethods
        }
        PHP;

            if (!file_put_contents($processorInterfaceFilePath, $interfaceContent)) {
                throw new RuntimeException("Failed to create processor interface at: $processorInterfaceFilePath");
            }

            $processorContent = <<<PHP
        <?php

        declare(strict_types=1);

        namespace $namespace;

        class $processorClassName implements $processorInterfaceName
        {
         $methods

        }
        PHP;

            file_put_contents($processorFilePath, $processorContent);
        }
    }

    protected function generateDir(string $moduleBasePath, $folderName): void
    {
        $directory = $moduleBasePath . '/' . $folderName;


        if (!is_dir($directory) && !mkdir($directory, 0777, true) && !is_dir($directory)) {
            throw new RuntimeException(sprintf('Directory "%s" was not created', $directory));
        }
    }

    /**
     * Generate method stubs for the plugin based on the configuration.
     *
     * @param array $data The plugin configuration.
     * @return string The generated method stubs.
     */
    protected function generateMethods(array $data): string
    {
        $methods = '';

        // Assuming methods are defined in the config. Adjust as per your actual config structure.
        foreach ($data['methods'] as $method) {
            $methodName = $method['name'];
            $body = $method['body'] ?? '';
            $methodReturnType = $method['returnType'] ?? 'void'; // Default return type or specified
            $methods .= <<<METHOD

        /**
         * @return $methodReturnType
         */
        public function $methodName(): $methodReturnType
        {
         $body
            // TODO: Implement $methodName.

        }

        METHOD;
        }

        return $methods;
    }

    /**
     * Generate method stubs for the plugin based on the configuration.
     *
     * @param array $data The plugin configuration.
     * @return string The generated method stubs.
     */
    protected function generateInterfaceMethods(array $data): string
    {
        $methods = '';

        // Assuming methods are defined in the config. Adjust as per your actual config structure.
        foreach ($data['methods'] as $method) {
            $methodName = $method['name'];

            $methodReturnType = $method['returnType'] ?? 'void'; // Default return type or specified
            $methods .= <<<METHOD

        /**
         * @return $methodReturnType
         */
        public function $methodName(): $methodReturnType;


        METHOD;
        }

        return $methods;
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
                $body = $action['body'] ?? '';
                $actionsCode .= <<<PHP

    /**
     * @param \\Generated\\Shared\\Transfer\\{$requestType} \$requestTransfer
     * @return \\Generated\\Shared\\Transfer\\{$responseType}
     */
    public function {$action['name']}($requestType \$requestTransfer): $responseType
    {
      $body
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
                $moduleNameResource = str_replace('BackendApi', '', $moduleName);
                $resourceType = $this->convertCamelCaseToScreamingSnakeCase($moduleNameResource);

                $pluginFileContent = <<<PHP
<?php

declare(strict_types=1);

namespace {$namespace};

use Spryker\Glue\GlueApplication\Plugin\GlueApplication\Backend\AbstractResourcePlugin;
use Spryker\Glue\GlueJsonApiConventionExtension\Dependency\Plugin\JsonApiResourceInterface;
use Generated\Shared\Transfer\GlueResourceMethodCollectionTransfer;
use Generated\Shared\Transfer\GlueResourceMethodConfigurationTransfer;
use Pyz\Glue\\{$moduleName}\\{$moduleName}Config;
use Pyz\Glue\\{$moduleName}\\Controller\\{$moduleNameResource}ResourceController;
use Pyz\Generated\\{$moduleName}\\Transfer\\{$moduleName}AttributesTransfer;

class {$pluginClassName} extends AbstractResourcePlugin implements JsonApiResourceInterface
{
    public function getType(): string
    {
        return {$moduleName}Config::RESOURCE_{$resourceType};
    }

    public function getController(): string
    {
        return {$moduleNameResource}ResourceController::class;
    }

    public function getDeclaredMethods(): GlueResourceMethodCollectionTransfer
    {
        return (new GlueResourceMethodCollectionTransfer())
            ->setGetCollection(
                (new GlueResourceMethodConfigurationTransfer())
                    ->setAttributes({$moduleName}AttributesTransfer::class)
            )
            ->setGet(
                (new GlueResourceMethodConfigurationTransfer())
                    ->setAttributes({$moduleName}AttributesTransfer::class)
            )
            ->setPost(
                (new GlueResourceMethodConfigurationTransfer())
                    ->setAttributes({$moduleName}AttributesTransfer::class)
            )
            ->setPatch(
                (new GlueResourceMethodConfigurationTransfer())
                    ->setAttributes({$moduleName}AttributesTransfer::class)
            );
    }
}
PHP;
                if (!file_put_contents($pluginPath, $pluginFileContent)) {
                    throw new RuntimeException("Failed to create plugin file at: $pluginPath");
                }
            }
        }
    }

    protected function convertCamelCaseToScreamingSnakeCase($input): string
    {
        // First, insert an underscore before each uppercase letter, except the first one
        $withUnderscores = preg_replace('/(?<!^)[A-Z]/', '_$0', $input);
        // Then, convert the entire string to uppercase
        return strtoupper($withUnderscores);
    }

    /**
     * Generate the transfer XML file for the module's transfer objects.
     *
     * @param string $moduleBasePath The base path for the module.
     * @param array $config The parsed YAML configuration for the module.
     */
    protected function generateTransferObjects(string $moduleBasePath, string $moduleName, array $transfers): void
    {
        $name = strtolower($this->convertCamelCaseToScreamingSnakeCase($moduleName));
        $transferXmlPath = sprintf('%s/src/Pyz/Shared/%s/Transfer/%s.transfer.xml', getcwd(), $moduleName, $name);

        // Ensure the directory for the transfer XML exists
        $transferXmlDirectory = dirname($transferXmlPath);
        if (!is_dir($transferXmlDirectory) && !mkdir($transferXmlDirectory, 0777,
                true) && !is_dir($transferXmlDirectory)) {
            throw new RuntimeException(sprintf('Directory "%s" was not created', $transferXmlDirectory));
        }

        $transfersContent = "<?xml version=\"1.0\"?>\n<transfers>\n";

        foreach ($transfers as $transfer) {
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
