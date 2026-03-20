<?php

declare(strict_types=1);

namespace Touta\Ogam;

final readonly class ExitCode
{
    public function __construct(
        public int $value,
    ) {}
}
