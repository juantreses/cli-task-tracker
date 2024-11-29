<?php

declare(strict_types=1);

namespace TaskMaster;

use InvalidArgumentException;
use RuntimeException;
use Throwable;

final class App
{
    private const string HELP_COMMAND = "help";

    public private(set) CliPrinter $cliPrinter;

    private array $registry = [];

    public function __construct(CliPrinter $cliPrinter)
    {
        $this->cliPrinter = $cliPrinter;
    }

    public function registerCommand(string $name, callable $command): void
    {
        if (empty($name)) {
            throw new InvalidArgumentException('Command name cannot be empty');
        }
        if (isset($this->registry[$name])) {
            throw new RuntimeException("Command '$name' is already registered");
        }
        $this->registry[$name] = $command;
    }

    private function getCommand(string $name): ?callable
    {
        return $this->registry[$name] ?? null;
    }

    public function runCommand(array $argv = []): void
    {
        if (empty($argv)) {
            $command_name = self::HELP_COMMAND;
        } else {
            $command_name = $argv[1] ?? self::HELP_COMMAND;
        }

        $command = $this->getCommand($command_name);
        if ($command === null) {
            $this->cliPrinter->display("ERROR: Command \"$command_name\" not found.");
            exit(1);
        }

        try {
            $command($argv);
        } catch (Throwable $e) {
            $this->cliPrinter->display("ERROR: Command execution failed: {$e->getMessage()}");
            exit(1);
        }
    }
}