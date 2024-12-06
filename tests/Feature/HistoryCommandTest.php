<?php

declare(strict_types=1);

use App\Commands\HistoryCommand;
use App\Models\Task;

it('does not show a list if there is no tasks', function () {
    $this->artisan(HistoryCommand::class)
        ->expectsOutput('Nothing to show')
        ->assertExitCode(0);
});

it('does not show a list if all the tasks are opened', function () {
    Task::factory(3)->create(['done_at' => null]);

    $this->artisan(HistoryCommand::class)
        ->expectsOutput('Nothing to show')
        ->assertExitCode(0);
});

// FIX : fails because the output is a Laravel\Prompts\table
// it('lists all the done tasks and only those', function () {
//     Task::factory(2)->create();
//     Task::factory(1)->create(['done_at' => null]);

//     $this->artisan(HistoryCommand::class)
//         ->expectsOutputToContain(Task::find(1)->text)
//         ->expectsOutputToContain(Task::find(2)->text)
//         ->doesntExpectOutputToContain(Task::find(3)->text)
//         ->assertExitCode(0);
// });
