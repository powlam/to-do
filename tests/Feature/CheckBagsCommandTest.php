<?php

declare(strict_types=1);

use App\Commands\CheckBagsCommand;
use App\Models\Bag;
use App\Models\Task;

it('lists all the bags', function () {
    Bag::factory(3)->create();

    $this->artisan(CheckBagsCommand::class)
        ->expectsOutputToContain(Bag::find(1)->name) // the default bag
        ->expectsOutputToContain(Bag::find(2)->name)
        ->expectsOutputToContain(Bag::find(3)->name)
        ->expectsOutputToContain(Bag::find(4)->name)
        ->assertExitCode(0);
});

it('indicates which is the active bag', function () {
    Bag::factory(3)->create();
    Bag::find(2)->setActive();

    $this->artisan(CheckBagsCommand::class)
        ->expectsOutputToContain('► Bag 2 ')
        ->assertExitCode(0);
});

it('says which bags have opened tasks', function () {
    Bag::factory(2)->create();
    Task::factory(3)->create(['bag_id' => 1, 'done_at' => null]);
    Task::factory(2)->create(['bag_id' => 2]);

    $this->artisan(CheckBagsCommand::class)
        ->expectsOutputToContain('Bag '.Bag::find(1)->description.' has pending tasks')
        ->expectsOutputToContain('Bag '.Bag::find(2)->description.' is up to date')
        ->expectsOutputToContain('Bag '.Bag::find(3)->description.' is up to date')
        ->assertExitCode(0);
});
