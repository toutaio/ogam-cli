<?php

declare(strict_types=1);

namespace Touta\Ogam;

abstract class Command
{
    abstract public function name(): string;

    abstract public function description(): string;

    abstract public function execute(CommandInput $input): int;
}
