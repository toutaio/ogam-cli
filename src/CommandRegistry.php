<?php

declare(strict_types=1);

namespace Touta\Ogam;

use Touta\Aria\Runtime\Failure;
use Touta\Aria\Runtime\Result;
use Touta\Aria\Runtime\Success;

final class CommandRegistry
{
    /** @var array<string, Command> */
    private array $commands = [];

    public function register(Command $command): void
    {
        $this->commands[$command->name()->value] = $command;
    }

    /**
     * @return Success<Command>|Failure<CliError>
     */
    public function resolve(CommandName $name): Result
    {
        if (!isset($this->commands[$name->value])) {
            return Failure::from(new CliError(
                CliError::COMMAND_NOT_FOUND,
                "No command registered with name \"{$name->value}\"",
                ['name' => $name->value],
            ));
        }

        return Success::of($this->commands[$name->value]);
    }

    /**
     * @return list<Command>
     */
    public function all(): array
    {
        return array_values($this->commands);
    }
}
