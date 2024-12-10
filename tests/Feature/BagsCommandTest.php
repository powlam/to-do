<?php

declare(strict_types=1);

use App\Commands\BagsCommand;
use App\Models\Bag;

it('lists all the bags', function () {
    Bag::factory(3)->create();

    $this->artisan(BagsCommand::class)
        ->expectsOutputToContain(Bag::find(1)->name) // the default bag
        ->expectsOutputToContain(Bag::find(2)->name)
        ->expectsOutputToContain(Bag::find(3)->name)
        ->expectsOutputToContain(Bag::find(4)->name)
        ->assertExitCode(0);
});

it('indicates which is the active bag', function () {
    Bag::factory(3)->create();
    Bag::find(2)->setActive();

    $this->artisan(BagsCommand::class)
        ->expectsOutputToContain('► 2 ')
        ->assertExitCode(0);
});
