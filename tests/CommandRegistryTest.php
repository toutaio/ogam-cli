<?php

declare(strict_types=1);

use Touta\Aria\Runtime\Failure;
use Touta\Aria\Runtime\Success;
use Touta\Ogam\Command;
use Touta\Ogam\CommandInput;
use Touta\Ogam\CommandRegistry;

it('registers and resolves a command', function (): void {
    $registry = new CommandRegistry();
    $command = createTestCommand('hello', 'Say hello');

    $registry->register($command);

    $result = $registry->resolve('hello');
    expect($result)->toBeInstanceOf(Success::class)
        ->and($result->value()->name())->toBe('hello');
});

it('returns failure for unknown command', function (): void {
    $registry = new CommandRegistry();

    $result = $registry->resolve('missing');
    expect($result)->toBeInstanceOf(Failure::class);
});

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

        public function name(): string
        {
            return $this->cmdName;
        }

        public function description(): string
        {
            return $this->desc;
        }

        public function execute(CommandInput $input): int
        {
            return 0;
        }
    };
}
