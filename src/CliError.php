<?php

declare(strict_types=1);

namespace Touta\Ogam;

final readonly class CliError
{
    public const COMMAND_NOT_FOUND = 'CLI.COMMAND_NOT_FOUND';
    public const INVALID_ARGUMENT = 'CLI.INVALID_ARGUMENT';
    public const EXECUTION_FAILED = 'CLI.EXECUTION_FAILED';

    /**
     * @param array<string, mixed> $context
     */
    public function __construct(
        public string $code,
        public string $message,
        public array $context = [],
    ) {}

    public function withMessage(string $message): self
    {
        return new self($this->code, $message, $this->context);
    }

    /**
     * @param array<string, mixed> $context
     */
    public function withContext(array $context): self
    {
        return new self($this->code, $this->message, array_merge($this->context, $context));
    }
}
