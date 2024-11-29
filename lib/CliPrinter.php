<?php

declare(strict_types=1);

namespace TaskMaster;

/**
 * CliPrinter handles console output formatting and display.
 * It provides methods for consistent output presentation.
 */
final readonly class CliPrinter
{
    public function out(string $message): void
    {
        echo $message;
    }

    public function newLine(): void
    {
        $this->out("\n");
    }

    public function display(string $message): void
    {
        $this->newLine();
        $this->out($message);
        $this->newLine();
        $this->newLine();
    }
}