<?php

declare(strict_types=1);

namespace Touta\Ogam;

final readonly class CommandInput
{
    /**
     * @param list<string> $arguments
     */
    public function __construct(
        private array $arguments,
    ) {}

    public function argument(int $index): ?string
    {
        return $this->arguments[$index] ?? null;
    }

    /**
     * @return list<string>
     */
    public function arguments(): array
    {
        return $this->arguments;
    }
}
