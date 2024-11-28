<?php

declare(strict_types=1);

namespace TaskMaster;

final class App
{
    public private(set) CliPrinter $cliPrinter;

    private array $registry = [];

    public function __construct()
    {
        $this->cliPrinter = new CliPrinter();
    }

    public function registerCommand(string $name, callable $command): void
    {
        $this->registry[$name] = $command;
    }

    private function getCommand(string $name): ?callable
    {
        return $this->registry[$name] ?? null;
    }

    public function runCommand(array $argv = []): void
    {
        $command_name = $argv[1] ?? "help";

        $command = $this->getCommand($command_name);
        if ($command === null) {
            $this->cliPrinter->display("ERROR: Command \"$command_name\" not found.");
            exit;
        }

        $command($argv);
    }
}