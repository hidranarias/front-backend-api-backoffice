<?php

declare(strict_types=1);

namespace Pyz\Zed\Toolbox\Business\Writer;

use InvalidArgumentException;
use RuntimeException;
use Symfony\Component\Yaml\Yaml;

class ZedModuleGenerator implements ModuleGeneratorInterface
{
    public function generateModuleFromName(string $name): void
    {
        $content = $this->getDefaultModuleYmlConfig($name);
        //  echo $content;
        // die;
        $this->generateModuleFromConfig('', $content);
    }

    protected function getDefaultModuleYmlConfig(string $moduleName): string
    {
        $normalizedModuleName = ucfirst(strtolower($moduleName));
        $constantName = strtoupper($moduleName);

        $yml = <<<YML
module:
    name: $normalizedModuleName
    namespace: Pyz\Zed\\{$normalizedModuleName}
    config:
        constants:
            - name: MODULE_NAME
              value: $constantName
    business:
        services:
            - name: {$normalizedModuleName}Mapper
              folder: Mapper
              interface: {$normalizedModuleName}MapperInterface
              class: {$normalizedModuleName}Mapper
            - name: {$normalizedModuleName}Reader
              folder: Reader
              interface: {$normalizedModuleName}ReaderInterface
              class: {$normalizedModuleName}Reader
            - name: {$normalizedModuleName}Writer
              folder: Writer
              interface: {$normalizedModuleName}WriterInterface
              class: {$normalizedModuleName}Writer
            - name: {$normalizedModuleName}Deleter
              folder: Deleter
              interface: {$normalizedModuleName}DeleterInterface
              class: {$normalizedModuleName}Deleter
            - name: {$normalizedModuleName}Updater
              folder: Updater
              interface: {$normalizedModuleName}UpdaterInterface
              class: {$normalizedModuleName}Updater
    controllers:
        - name: {$normalizedModuleName}Controller
          actions:
            - name: indexAction
              request: Request
              response: array
    views:
        - name: $normalizedModuleName
        - name: index


    transfers:
        - name: {$normalizedModuleName}Transfer
          properties:
            - name: id
              type: int
            - name: name
              type: string
YML;

        return $yml;
    }

    public function generateModuleFromConfig(string $configFilePath = '', string $content = ''): void
    {
        $config = $this->getConfig($content, $configFilePath);
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
        die();
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


    public function getConfig(string $content, string $configFilePath): mixed
    {
        if ($content) {
            $config = Yaml::parse($content);
        } else {
            if (!file_exists($configFilePath)) {
                throw new RuntimeException(sprintf('The configuration file "%s" does not exist.', $configFilePath));
            }

            $config = Yaml::parseFile($configFilePath);
        }
        return $config;
    }

    protected function validateConfig(array $config): void
    {
        $requiredSections = ['name', 'namespace'];
        foreach ($requiredSections as $section) {
            if (empty($config['module'][$section])) {
                throw new InvalidArgumentException("Missing required module section: $section");
            }
        }
        // Optionally, add more specific validations here based on your module requirements.
    }

    protected function createModuleBasePath(string $moduleNamespace, string $moduleName): string
    {
        return sprintf('%s/src/%s', getcwd(), str_replace('\\', '/', $moduleNamespace));
    }

    protected function generateModuleDirectories(string $moduleBasePath): void
    {
        $directories = [
            "$moduleBasePath/Business",
            "$moduleBasePath/Business/Reader",
            "$moduleBasePath/Business/Writer",
            "$moduleBasePath/Communication",
            "$moduleBasePath/Communication/Controller",
            "$moduleBasePath/Persistence",
            "$moduleBasePath/Persistence/Propel",
            "$moduleBasePath/Persistence/Mapper",
            "$moduleBasePath/Presentation",
        ];

        foreach ($directories as $directory) {
            if (!is_dir($directory) && !mkdir($directory, 0775, true) && !is_dir($directory)) {
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
        $namespace = $moduleNamespace . '\\Config';

        $constantsCode = '';
        foreach ($config['config']['constants'] as $constant) {
            $constantsCode .= "    public const {$constant['name']} = '{$constant['value']}';\n";
        }

        $configFileContent = <<<PHP
    <?php

    declare(strict_types=1);

    namespace $namespace;

    use Spryker\Zed\Kernel\AbstractBundleConfig;

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
        $dependencyProviderPath = sprintf('%s/%sDependencyProvider.php', $moduleBasePath,
            $moduleName);
        $namespace = $moduleNamespace;

        $dependencyProviderContent = <<<PHP
    <?php

    declare(strict_types=1);

    namespace $namespace;

    use Spryker\Zed\Kernel\Container;
    use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;

    class {$moduleName}DependencyProvider extends AbstractBundleDependencyProvider
    {
        public function provideBusinessLayerDependencies(Container \$container): Container
        {
        parent::provideBusinessLayerDependencies(\$container)\
            return \$container;
        }
    }
    PHP;

        file_put_contents($dependencyProviderPath, $dependencyProviderContent);
    }

    protected function generateProcessors(string $moduleBasePath, string $moduleNamespace, array $config): void
    {
        $businessPath = sprintf('%s/Business/', $moduleBasePath);
        if (!is_dir($businessPath) && !mkdir($businessPath, 0775, true) && !is_dir($businessPath)) {
            throw new RuntimeException(sprintf('Directory "%s" was not created', $businessPath));
        }

        foreach ($config['business']['services'] as $service) {
            $processorClassName = $service['class'];
            $folderName = $service['folder'];
            $processorInterfaceName = $service['interface'];
            $processorClassFilePath = $businessPath . $folderName . '/' . $processorClassName . '.php';
            $processorInterfaceFilePath = $businessPath . $folderName . '/' . $processorInterfaceName . '.php';

            // Assuming $service['method'] contains method definitions for the interface
            $interfaceMethods = '';


            if (isset($service['methods'])) {
                $interfaceMethods = $this->generateInterfaceMethods($service['methods']);
            }

            $interfaceContent = <<<PHP
        <?php

        namespace $moduleNamespace\\Business\\{$folderName};

        interface $processorInterfaceName
        {
            $interfaceMethods
        }
        PHP;
            $folderPath = $businessPath . $folderName;
            if (!is_dir($folderPath) && !mkdir($folderPath, 0775, true) && !is_dir($folderPath)) {
                throw new RuntimeException(sprintf('Directory "%s" was not created', $folderPath));
            }
            file_put_contents($processorInterfaceFilePath, $interfaceContent);

            $classContent = <<<PHP
        <?php

        namespace $moduleNamespace\\Business\\{$folderName};

        class $processorClassName implements $processorInterfaceName
        {
            // Implement the methods defined in the interface
        }
        PHP;

            file_put_contents($processorClassFilePath, $classContent);
        }
    }

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

    protected function generateFactoryFile(
        string $moduleBasePath,
        string $moduleNamespace,
        string $moduleName,
        array $config
    ): void {
        $factoryFilePath = sprintf('%s/Business/%sBusinessFactory.php', $moduleBasePath, $moduleName);
        $namespace = $moduleNamespace . '\\Business';

        $serviceMethods = '';
        foreach ($config['business']['services'] as $service) {
            $serviceName = $service['name'];
            $serviceInterface = $service['interface'];
            $serviceClass = $service['class'];
            $serviceMethods .= <<<PHP

        /**
         * @return \\$serviceInterface
         */
        public function create$serviceName(): $serviceInterface
        {
            return new $serviceClass();
        }

        PHP;
        }

        $factoryFileContent = <<<PHP
    <?php

    declare(strict_types=1);

    namespace $namespace;

    use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

    class {$moduleName}BusinessFactory extends AbstractBusinessFactory
    {
    $serviceMethods
    }
    PHP;

        file_put_contents($factoryFilePath, $factoryFileContent);
    }

    protected function generateControllers(
        string $moduleBasePath,
        string $moduleNamespace,
        string $moduleName,
        array $config
    ): void {
        $controllerPath = sprintf('%s/Communication/Controller', $moduleBasePath);
        if (!is_dir($controllerPath) && !mkdir($controllerPath, 0775, true) && !is_dir($controllerPath)) {
            throw new RuntimeException(sprintf('Directory "%s" was not created', $controllerPath));
        }

        foreach ($config['controllers'] as $controller) {
            $controllerClassName = $controller['name'] . 'Controller';
            $controllerFilePath = $controllerPath . '/' . $controllerClassName . '.php';

            $actionsCode = $this->generateControllerActions($controller['actions']);

            $controllerContent = <<<PHP
        <?php

        namespace $moduleNamespace\\Communication\\Controller;

        use Spryker\\Zed\\Kernel\\Communication\\Controller\\AbstractController;

        class $controllerClassName extends AbstractController
        {
            $actionsCode
        }
        PHP;

            file_put_contents($controllerFilePath, $controllerContent);
        }
    }

    protected function generateTransferObjects(string $moduleBasePath, string $moduleName, array $transfers): void
    {
        $transferXmlPath = sprintf('%s/src/Pyz/Zed/%s/Shared/%s/Transfer/%s.transfer.xml', getcwd(), $moduleName,
            $moduleName, strtolower($moduleName));

        // Ensure the directory for the transfer XML exists
        if (!is_dir(dirname($transferXmlPath)) && !mkdir($concurrentDirectory = dirname($transferXmlPath), 0775,
                true) && !is_dir($concurrentDirectory)) {
            throw new RuntimeException(sprintf('Directory "%s" was not created', dirname($transferXmlPath)));
        }

        $transfersContent = "<?xml version=\"1.0\"?>\n<transfers>\n";
        foreach ($transfers as $transfer) {
            $transfersContent .= "    <transfer name=\"{$transfer['name']}\" strict=\"true\">\n";
            foreach ($transfer['properties'] as $property) {
                $transfersContent .= "        <property name=\"{$property['name']}\" type=\"{$property['type']}\"/>\n";
            }
            $transfersContent .= "    </transfer>\n";
        }
        $transfersContent .= '</transfers>';

        file_put_contents($transferXmlPath, $transfersContent);
    }

    protected function generateFile(string $filePath, string $fileContent): void
    {
        $directoryPath = dirname($filePath);
        if (!is_dir($directoryPath) && !mkdir($directoryPath, 0775, true) && !is_dir($directoryPath)) {
            throw new RuntimeException(sprintf('Directory "%s" was not created', $directoryPath));
        }

        if (!file_put_contents($filePath, $fileContent)) {
            throw new RuntimeException(sprintf('Failed to create file at: %s', $filePath));
        }
    }

}
