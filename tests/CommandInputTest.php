<?php

declare(strict_types=1);

use Touta\Ogam\ArgumentValue;
use Touta\Ogam\CommandInput;

// Scenario: CommandInput provides branded ArgumentValue by position
it('provides arguments by position', function (): void {
    $input = new CommandInput([new ArgumentValue('greet'), new ArgumentValue('world')]);

    expect($input->argument(0))->toBeInstanceOf(ArgumentValue::class)
        ->and($input->argument(0)->value)->toBe('greet')
        ->and($input->argument(1)->value)->toBe('world');
});

// Scenario: CommandInput returns null for missing argument index
it('returns null for missing argument', function (): void {
    $input = new CommandInput([]);

    expect($input->argument(0))->toBeNull();
});

// Scenario: CommandInput returns all branded ArgumentValue items
it('returns all arguments', function (): void {
    $input = new CommandInput([new ArgumentValue('a'), new ArgumentValue('b'), new ArgumentValue('c')]);

    expect($input->arguments())->toHaveCount(3)
        ->and($input->arguments()[0]->value)->toBe('a')
        ->and($input->arguments()[1]->value)->toBe('b')
        ->and($input->arguments()[2]->value)->toBe('c');
});
