<?php

declare(strict_types=1);

namespace Touta\Ogam;

final readonly class CommandInput
{
    /**
     * @param list<ArgumentValue> $arguments
     */
    public function __construct(
        private array $arguments,
    ) {}

    public function argument(int $index): ?ArgumentValue
    {
        return $this->arguments[$index] ?? null;
    }

    /**
     * @return list<ArgumentValue>
     */
    public function arguments(): array
    {
        return $this->arguments;
    }
}
