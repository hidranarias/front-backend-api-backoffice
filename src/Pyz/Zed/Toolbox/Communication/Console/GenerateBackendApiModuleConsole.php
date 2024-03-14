<?php

declare(strict_types=1);

namespace Pyz\Zed\Toolbox\Communication\Console;

use Spryker\Zed\Kernel\Communication\Console\Console;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * @method \Pyz\Zed\Toolbox\Business\ToolboxFacadeInterface getFacade()
 */
class GenerateBackendApiModuleConsole extends Console
{
    protected const COMMAND_NAME = 'toolbox:generate-module';
    protected const DESCRIPTION = "Generates a module from a YML configuration or name.
    \n Specify a type and a name or config file";
    protected const OPTION_CONFIG = 'config';
    protected const OPTION_NAME = 'name';
    protected const OPTION_TYPE = 'type';

    protected function configure(): void
    {
        $this
            ->setName(static::COMMAND_NAME)
            ->setAliases(['tgm', 't:g:m', 'tbgm'])
            ->setDescription(static::DESCRIPTION)
            ->addOption(static::OPTION_CONFIG, 'c', InputOption::VALUE_OPTIONAL,
                'The path to the YAML configuration file.')
            ->addOption(static::OPTION_NAME, 'm', InputOption::VALUE_OPTIONAL, 'The module\'s name')
            ->addOption(static::OPTION_TYPE, 't', InputOption::VALUE_REQUIRED,
                'The type of the module (Zed, Yves, Client, FrontendApi, BackendApi).');

        parent::configure();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $type = $input->getOption(static::OPTION_TYPE);
        if (!$type) {
            return $this->outputError($output, 'Please, specify a type: (Zed, Yves, Client, FrontendApi, BackendApi)');
        }

        $configFilePath = $input->getOption(static::OPTION_CONFIG);
        $name = $input->getOption(static::OPTION_NAME);

        if ($configFilePath && !file_exists($configFilePath)) {
            return $this->outputError($output, sprintf('The configuration file "%s" does not exist.', $configFilePath));
        }

        if (!$configFilePath && !$name) {
            return $this->outputError($output, 'Either config file or module name has to be provided');
        }

        return $this->generateModule($type, $configFilePath, $name, $output);
    }

    protected function outputError(OutputInterface $output, string $message): int
    {
        $output->writeln(sprintf('<error>%s</error>', $message));
        return static::FAILURE;
    }

    protected function generateModule(
        string $type,
        ?string $configFilePath,
        ?string $name,
        OutputInterface $output
    ): int {
        try {
            switch (strtolower($type)) {
                case 'zed':
                case 'yves':
                case 'client':
                case 'frontendapi':
                case 'backendapi':
                    $methodName = 'generate' . ucfirst($type) . 'ModuleFrom' . ($configFilePath ? 'Config' : 'Name');
                    $this->getFacade()->$methodName($configFilePath ?? $name);
                    break;
                default:
                    return $this->outputError($output, 'Invalid module type specified.');
            }
        } catch (\Exception $e) {
            return $this->outputError($output, $e->getMessage());
        }

        $output->writeln('<info>Module generated successfully.</info>');
        return static::SUCCESS;
    }
}
