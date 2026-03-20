<?php

declare(strict_types=1);

namespace Touta\Ogam;

use Touta\Aria\Runtime\Result;

abstract class Command
{
    abstract public function name(): CommandName;

    abstract public function description(): string;

    /**
     * @return Result<ExitCode, CliError>
     */
    abstract public function execute(CommandInput $input): Result;
}
