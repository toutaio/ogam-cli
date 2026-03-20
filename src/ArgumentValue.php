<?php

declare(strict_types=1);

namespace Touta\Ogam;

final readonly class ArgumentValue
{
    public function __construct(
        public string $value,
    ) {}
}
