<?php

declare(strict_types=1);

use Touta\Aria\Runtime\Result;
use Touta\Aria\Runtime\Success;
use Touta\Ogam\Command;
use Touta\Ogam\CommandInput;
use Touta\Ogam\CommandName;
use Touta\Ogam\ExitCode;

// Scenario: Command exposes its branded name and description
it('creates a command with name and description', function (): void {
    $command = new class extends Command {
        public function name(): CommandName
        {
            return new CommandName('greet');
        }

        public function description(): string
        {
            return 'Say hello';
        }

        public function execute(CommandInput $input): Result
        {
            return Success::of(new ExitCode(0));
        }
    };

    expect($command->name())->toBeInstanceOf(CommandName::class)
        ->and($command->name()->value)->toBe('greet')
        ->and($command->description())->toBe('Say hello');
});

// Scenario: Command::execute returns Result<ExitCode, CliError> on success
it('executes and returns Result wrapping ExitCode', function (): void {
    $command = new class extends Command {
        public function name(): CommandName
        {
            return new CommandName('test');
        }

        public function description(): string
        {
            return 'Test command';
        }

        public function execute(CommandInput $input): Result
        {
            return Success::of(new ExitCode(42));
        }
    };

    $result = $command->execute(new CommandInput([]));

    expect($result)->toBeInstanceOf(Success::class)
        ->and($result->value())->toBeInstanceOf(ExitCode::class)
        ->and($result->value()->value)->toBe(42);
});
