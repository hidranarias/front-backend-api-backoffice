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
    public const COMMAND_NAME = 'toolbox:generate-backendapi-module';
    public const DESCRIPTION = 'Generates a BackendAPI module from a YAML configuration.';
    public const OPTION_CONFIG = 'config';
    public const OPTION_CONFIG_SHORTCUT = 'c';

    /**
     * This method configures the console command. It sets the name, description, and options.
     */
    protected function configure(): void
    {
        $this
            ->setName(static::COMMAND_NAME)
            ->setDescription(static::DESCRIPTION)
            ->addOption(
                static::OPTION_CONFIG,
                static::OPTION_CONFIG_SHORTCUT,
                InputOption::VALUE_REQUIRED,
                'The path to the YAML configuration file.'
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

        if (!file_exists($configFilePath)) {
            $output->writeln(sprintf('<error>The configuration file "%s" does not exist.</error>', $configFilePath));
            return static::FAILURE;
        }

        $this->getFacade()->generateModuleFromConfig($configFilePath);

        $output->writeln('<info>Module generated successfully.</info>');

        return static::SUCCESS;
    }
}
