<?php

declare(strict_types=1);

use App\Commands\ClearCommand;
use App\Models\Task;

it('does nothing if not confirmed', function () {
    Task::factory()->create();

    $this->artisan(ClearCommand::class)
        ->expectsConfirmation('Are you sure? This will remove every task FOREVER', 'no')
        ->expectsOutput('Nothing done')
        ->assertExitCode(0);

    expect(Task::count())->toBe(1);
});

it('removes every task if confirmed', function () {
    Task::factory()->create();

    $this->artisan(ClearCommand::class)
        ->expectsConfirmation('Are you sure? This will remove every task FOREVER', 'yes')
        ->expectsOutput('All the tasks have been removed')
        ->assertExitCode(0);

    expect(Task::count())->toBe(0);
});
