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
    Task::factory()->create(['bag_id' => 1]);

    $this->artisan(ClearCommand::class)
        ->expectsConfirmation('Are you sure? This will remove every task FOREVER', 'yes')
        ->expectsOutput('All the tasks have been removed')
        ->assertExitCode(0);

    expect(Task::count())->toBe(0);
});

it('does not remove tasks of other bags', function () {
    Task::factory()->create(['bag_id' => 1]);
    Task::factory()->create();

    $this->artisan(ClearCommand::class)
        ->expectsConfirmation('Are you sure? This will remove every task FOREVER', 'yes')
        ->expectsOutput('All the tasks have been removed')
        ->assertExitCode(0);

    expect(Task::ofActiveBag()->count())->toBe(0);
    expect(Task::count())->toBe(1);
});
