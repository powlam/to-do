<?php

declare(strict_types=1);

use App\Commands\BagNewCommand;
use App\Models\Bag;
use Illuminate\Database\Schema\Builder;
use Illuminate\Support\Str;

it('does nothing if the text is too long', function () {
    $this->artisan(BagNewCommand::class)
        ->expectsQuestion('Bag name', Str::random(Builder::$defaultStringLength + 1))
        ->expectsOutputToContain('Too long')
        ->assertExitCode(0);

    expect(Bag::count())->toBe(1);
});

it('does nothing if a bag with this name already exists', function () {
    $this->artisan(BagNewCommand::class)
        ->expectsQuestion('Bag name', 'default')
        ->expectsOutputToContain('The bag already exists')
        ->assertExitCode(0);

    expect(Bag::count())->toBe(1);
});

it('adds a bag', function () {
    $this->artisan(BagNewCommand::class)
        ->expectsQuestion('Bag name', 'The new bag')
        ->expectsOutputToContain('Bag created')
        ->expectsOutputToContain('The new bag')
        ->assertExitCode(0);

    expect(Bag::count())->toBe(2); // 1 default + 1 new
});
