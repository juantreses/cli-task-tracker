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
        $this->out(PHP_EOL);
    }

    public function display(string $message, int $beforeLines = 1, int $afterLines = 2): void
    {
        for ($i = 0; $i < $beforeLines; $i++) {
            $this->newLine();
        }
        $this->out($message);
        for ($i = 0; $i < $afterLines; $i++) {
            $this->newLine();
        }
    }
}