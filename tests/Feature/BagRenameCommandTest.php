<?php

declare(strict_types=1);

use App\Commands\BagRenameCommand;
use App\Models\Bag;
use Illuminate\Database\Schema\Builder;
use Illuminate\Support\Str;

it('does nothing if the bag does not exist', function () {
    $this->artisan(BagRenameCommand::class, ['bag' => 2])
        ->expectsQuestion('Bag name', 'Bad bag')
        ->expectsOutputToContain('Bag not found')
        ->assertExitCode(0);
});

it('does nothing if the bag id is a string', function () {
    $this->artisan(BagRenameCommand::class, ['bag' => 'asdf'])
        ->expectsQuestion('Bag name', 'Bad bag')
        ->expectsOutputToContain('Bag not found')
        ->assertExitCode(0);
});

it('does nothing if the text is too long', function () {
    $this->artisan(BagRenameCommand::class)
        ->expectsQuestion('Bag name', Str::random(Builder::$defaultStringLength + 1))
        ->expectsOutputToContain('Too long')
        ->assertExitCode(0);
});

it('does nothing if a bag with this name already exists', function () {
    $this->artisan(BagRenameCommand::class)
        ->expectsQuestion('Bag name', 'default')
        ->expectsOutputToContain('The bag already exists')
        ->assertExitCode(0);
});

it('renames the indicated bag', function () {
    $this->artisan(BagRenameCommand::class, ['bag' => 1])
        ->expectsQuestion('Bag name', 'The new name')
        ->expectsOutputToContain('Bag renamed')
        ->expectsOutputToContain('The new name')
        ->assertExitCode(0);

    expect(Bag::find(1)->name)->toBe('The new name');
});

it('renames the active bag', function () {
    $this->artisan(BagRenameCommand::class)
        ->expectsQuestion('Bag name', 'The new name')
        ->expectsOutputToContain('Bag renamed')
        ->expectsOutputToContain('The new name')
        ->assertExitCode(0);

    expect(Bag::where('is_active', true)->first()->name)->toBe('The new name');
});
