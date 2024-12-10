<?php

declare(strict_types=1);

use App\Commands\BagCommand;
use App\Models\Bag;

it('does nothing if the bag does not exist', function () {
    $this->artisan(BagCommand::class, ['bag' => 4])
        ->expectsOutputToContain('Bag not found')
        ->assertExitCode(0);
});

it('does nothing if the bag id is a string', function () {
    $this->artisan(BagCommand::class, ['bag' => 'asdf'])
        ->expectsOutputToContain('Bag not found')
        ->assertExitCode(0);
});

it('changes the active bag', function () {
    Bag::factory(3)->create();

    $this->artisan(BagCommand::class, ['bag' => 2])
        ->expectsOutputToContain('Bag '.Bag::find(2)->description.' is now active')
        ->assertExitCode(0);

    expect(Bag::find(2)->is_active)->toBe(true);
});
