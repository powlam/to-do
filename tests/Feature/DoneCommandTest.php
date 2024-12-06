<?php

declare(strict_types=1);

use App\Commands\DoneCommand;
use App\Models\Task;

it('does nothing if the task does not exist', function () {
    $this->artisan(DoneCommand::class, ['task' => 1])
        ->expectsOutput('The task does not exist')
        ->assertExitCode(0);

    expect(Task::count())->toBe(0);
});

it('does nothing if the task id is a string', function () {
    $this->artisan(DoneCommand::class, ['task' => 'asdf'])
        ->expectsOutput('The task does not exist')
        ->assertExitCode(0);

    expect(Task::count())->toBe(0);
});

it('does nothing if the task is already marked as done', function () {
    Task::factory()->create();

    expect(Task::count())->toBe(1);
    expect(Task::opened()->count())->toBe(0);

    $this->artisan(DoneCommand::class, ['task' => 1])
        ->expectsOutput('The task is already marked as done')
        ->assertExitCode(0);

    expect(Task::count())->toBe(1);
    expect(Task::opened()->count())->toBe(0);
});

it('marks the task as done', function () {
    Task::factory()->create(['done_at' => null]);

    expect(Task::count())->toBe(1);
    expect(Task::opened()->count())->toBe(1);

    $this->artisan(DoneCommand::class, ['task' => 1])
        ->expectsOutput('Task marked as done')
        ->assertExitCode(0);

    expect(Task::count())->toBe(1);
    expect(Task::opened()->count())->toBe(0);
});
