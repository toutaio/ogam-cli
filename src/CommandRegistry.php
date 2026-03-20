<?php

declare(strict_types=1);

namespace Touta\Ogam;

use Touta\Aria\Runtime\Failure;
use Touta\Aria\Runtime\Result;
use Touta\Aria\Runtime\StructuredFailure;
use Touta\Aria\Runtime\Success;

final class CommandRegistry
{
    /** @var array<string, Command> */
    private array $commands = [];

    public function register(Command $command): void
    {
        $this->commands[$command->name()] = $command;
    }

    /**
     * @return Success<Command>|Failure<StructuredFailure>
     */
    public function resolve(string $name): Result
    {
        if (!isset($this->commands[$name])) {
            return Failure::from(new StructuredFailure(
                'COMMAND_NOT_FOUND',
                "No command registered with name \"{$name}\"",
                ['name' => $name],
            ));
        }

        return Success::of($this->commands[$name]);
    }

    /**
     * @return list<Command>
     */
    public function all(): array
    {
        return array_values($this->commands);
    }
}
