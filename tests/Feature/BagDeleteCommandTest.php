<?php

declare(strict_types=1);

use App\Commands\BagDeleteCommand;
use App\Models\Bag;

it('does nothing if not confirmed', function () {
    $initial_bag_count = Bag::count();

    $this->artisan(BagDeleteCommand::class)
        ->expectsConfirmation('Are you sure? This will remove FOREVER the bag', 'no')
        ->expectsOutput('Nothing done')
        ->assertExitCode(0);

    expect(Bag::count())->toBe($initial_bag_count);
});

it('does nothing if the bag does not exist', function () {
    $this->artisan(BagDeleteCommand::class, ['bag' => 2])
        ->expectsConfirmation('Are you sure? This will remove FOREVER the bag', 'yes')
        ->expectsOutputToContain('Bag not found')
        ->assertExitCode(0);
});

it('does nothing if the bag id is a string', function () {
    $this->artisan(BagDeleteCommand::class, ['bag' => 'asdf'])
        ->expectsConfirmation('Are you sure? This will remove FOREVER the bag', 'yes')
        ->expectsOutputToContain('Bag not found')
        ->assertExitCode(0);
});

it('deletes the indicated bag', function () {
    Bag::factory()->create();

    $this->artisan(BagDeleteCommand::class, ['bag' => 2])
        ->expectsConfirmation('Are you sure? This will remove FOREVER the bag', 'yes')
        ->expectsOutputToContain('Bag deleted')
        ->assertExitCode(0);

    expect(Bag::where('id', 2)->exists())->toBe(false);
});

it('deletes the active bag and sets another one as active', function () {
    Bag::factory()->create();
    expect(Bag::where('id', 1)->active()->exists())->toBe(true);

    $this->artisan(BagDeleteCommand::class)
        ->expectsConfirmation('Are you sure? This will remove FOREVER the bag', 'yes')
        ->expectsOutputToContain('Bag deleted')
        ->assertExitCode(0);

    expect(Bag::where('id', 1)->exists())->toBe(false);
    expect(Bag::active()->exists())->toBe(true);
});

it('deletes the only existing bag and creates another one as active', function () {
    expect(Bag::where('id', 1)->active()->exists())->toBe(true);
    expect(Bag::count())->toBe(1);

    $this->artisan(BagDeleteCommand::class)
        ->expectsConfirmation('Are you sure? This will remove FOREVER the bag', 'yes')
        ->expectsOutputToContain('Bag deleted')
        ->assertExitCode(0);

    expect(Bag::where('id', 1)->exists())->toBe(false);
    expect(Bag::active()->exists())->toBe(true);
});
