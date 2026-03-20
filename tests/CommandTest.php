<?php

declare(strict_types=1);

use Touta\Ogam\Command;
use Touta\Ogam\CommandInput;

it('creates a command with name and description', function (): void {
    $command = new class extends Command {
        public function name(): string
        {
            return 'greet';
        }

        public function description(): string
        {
            return 'Say hello';
        }

        public function execute(CommandInput $input): int
        {
            return 0;
        }
    };

    expect($command->name())->toBe('greet')
        ->and($command->description())->toBe('Say hello');
});

it('executes and returns exit code', function (): void {
    $command = new class extends Command {
        public function name(): string
        {
            return 'test';
        }

        public function description(): string
        {
            return 'Test command';
        }

        public function execute(CommandInput $input): int
        {
            return 42;
        }
    };

    $result = $command->execute(new CommandInput([]));

    expect($result)->toBe(42);
});
