<?php

declare(strict_types=1);

use Touta\Ogam\CommandInput;

it('provides arguments by position', function (): void {
    $input = new CommandInput(['greet', 'world']);

    expect($input->argument(0))->toBe('greet')
        ->and($input->argument(1))->toBe('world');
});

it('returns null for missing argument', function (): void {
    $input = new CommandInput([]);

    expect($input->argument(0))->toBeNull();
});

it('returns all arguments', function (): void {
    $input = new CommandInput(['a', 'b', 'c']);

    expect($input->arguments())->toBe(['a', 'b', 'c']);
});
