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
    public const COMMAND_NAME = 'toolbox:generate-module';
    public const DESCRIPTION = "Generates a  module from a YML configuration or name.
    \n Specify a type and a name or config file";
    public const OPTION_CONFIG = 'config';
    public const OPTION_CONFIG_SHORTCUT = 'c';
    public const OPTION_NAME = 'name';
    public const OPTION_NAME_SHORTCUT = 'm';
    public const OPTION_TYPE = 'type';
    public const OPTION_TYPE_SHORTCUT = 't';

    /**
     * This method configures the console command. It sets the name, description, and options.
     */
    protected function configure(): void
    {
        $this
            ->setName(static::COMMAND_NAME)
            ->setAliases(['tgm', 't:g:m', 'tbgm'])
            ->setDescription(static::DESCRIPTION)
            ->addOption(
                static::OPTION_CONFIG,
                static::OPTION_CONFIG_SHORTCUT,
                InputOption::VALUE_OPTIONAL,
                'The path to the YAML configuration file.'
            )->addOption(
                static::OPTION_NAME,
                static::OPTION_NAME_SHORTCUT,
                InputOption::VALUE_OPTIONAL,
                'The module\'s name'
            )
            ->addOption(
                static::OPTION_TYPE,
                static::OPTION_TYPE_SHORTCUT,
                InputOption::VALUE_REQUIRED,
                'The type of the module (Zed, Yves, Client, FrontendApi, BackendApi).'
            );
        parent::configure();
    }

    /**
     * This method is executed when the console command is called. It handles the logic of reading the YAML configuration,
     * generating the module, and outputting messages to the console.
     *
     * @param \Symfony\Component\Console\Input\InputInterface $input An InputInterface instance
     * @param \Symfony\Component\Console\Output\OutputInterface $output An OutputInterface instance
     *
     * @return int Return code of the command execution
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $configFilePath = $input->getOption(static::OPTION_CONFIG);
        $name = $input->getOption(static::OPTION_NAME);
        $type = $input->getOption(static::OPTION_TYPE);

        if (!$type) {
            $output->writeln('<error>Please, specify a type: (Zed, Yves, Client, FrontendApi, BackendApi)</error>');
            return static::FAILURE;
        }
        if ($configFilePath && !file_exists($configFilePath)) {
            $output->writeln(sprintf('<error>The configuration file "%s" does not exist.</error>', $configFilePath));
            return static::FAILURE;
        }
        if (!$configFilePath && !$name) {
            $output->writeln('<error>Either config file or module name has to be provided</error>');
            return static::FAILURE;
        }
        try {
            $moduleType = strtolower($type);
            switch (strtolower($moduleType)) {
                case 'zed':
                    if ($configFilePath) {
                        $this->getFacade()->generateZedModuleFromConfig($configFilePath);
                    } else {
                        $this->getFacade()->generateZedModuleFromName($name);
                    }
                    break;
                case 'yves':
                    $this->getFacade()->generateYvesModuleFromConfig($configFilePath);
                    break;
                case 'client':
                    $this->getFacade()->generateClientModuleFromConfig($configFilePath);
                    break;
                case 'frontendapi':
                case 'api':
                    $this->getFacade()->generateFrontendApiModuleFromConfig($configFilePath);
                    break;
                case 'backendapi':
                case 'backend':
                default:
                    $this->getFacade()->generateBackendApiModuleFromConfig($configFilePath);
                    break;
            }
        } catch (\Exception $e) {
            $output->writeln(sprintf('<error>%s</error>', $e->getMessage()));
            return static::FAILURE;
        }


        $output->writeln('<info>Module generated successfully.</info>');

        return static::SUCCESS;
    }
}
