<?php

declare(strict_types=1);

namespace Touta\Ogam;

final readonly class CommandName
{
    public function __construct(
        public string $value,
    ) {}
}
