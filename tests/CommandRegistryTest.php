<?php

declare(strict_types=1);

use Touta\Aria\Runtime\Failure;
use Touta\Aria\Runtime\Result;
use Touta\Aria\Runtime\Success;
use Touta\Ogam\CliError;
use Touta\Ogam\Command;
use Touta\Ogam\CommandInput;
use Touta\Ogam\CommandName;
use Touta\Ogam\CommandRegistry;
use Touta\Ogam\ExitCode;

// Scenario: Registry resolves a registered command by CommandName
it('registers and resolves a command', function (): void {
    $registry = new CommandRegistry();
    $command = createTestCommand('hello', 'Say hello');

    $registry->register($command);

    $result = $registry->resolve(new CommandName('hello'));
    expect($result)->toBeInstanceOf(Success::class)
        ->and($result->value()->name()->value)->toBe('hello');
});

// Scenario: Registry returns Failure<CliError> for unknown CommandName
it('returns failure for unknown command', function (): void {
    $registry = new CommandRegistry();

    $result = $registry->resolve(new CommandName('missing'));
    expect($result)->toBeInstanceOf(Failure::class)
        ->and($result->error())->toBeInstanceOf(CliError::class)
        ->and($result->error()->code)->toBe(CliError::COMMAND_NOT_FOUND);
});

// Scenario: Registry lists all registered commands
it('lists all registered commands', function (): void {
    $registry = new CommandRegistry();
    $registry->register(createTestCommand('a', 'First'));
    $registry->register(createTestCommand('b', 'Second'));

    $commands = $registry->all();
    expect($commands)->toHaveCount(2);
});

function createTestCommand(string $name, string $description): Command
{
    return new class ($name, $description) extends Command {
        public function __construct(
            private readonly string $cmdName,
            private readonly string $desc,
        ) {}

        public function name(): CommandName
        {
            return new CommandName($this->cmdName);
        }

        public function description(): string
        {
            return $this->desc;
        }

        public function execute(CommandInput $input): Result
        {
            return Success::of(new ExitCode(0));
        }
    };
}
