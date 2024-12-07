<?php

declare(strict_types=1);

use App\Commands\DoneAllCommand;
use App\Models\Task;

it('marks all the pending tasks as done', function () {
    Task::factory(3)->create(['bag_id' => 1, 'done_at' => null]);
    Task::factory(3)->create(['bag_id' => 1]);

    expect(Task::count())->toBe(6);
    expect(Task::opened()->count())->toBe(3);

    $this->artisan(DoneAllCommand::class)
        ->expectsOutput('All the tasks are marked as done')
        ->assertExitCode(0);

    expect(Task::count())->toBe(6);
    expect(Task::opened()->count())->toBe(0);
});

it('does not change the done date of already marked tasks', function () {
    $initialTime = now();
    Task::factory()->create(['done_at' => $initialTime]);
    Task::factory()->create(['done_at' => null]);

    $this->travel(3)->hours();

    $this->artisan(DoneAllCommand::class);

    expect(Task::find(1)->done_at->format('Y-m-d H:i:s') === $initialTime->format('Y-m-d H:i:s'))->toBeTrue();
    expect((int) Task::find(1)->done_at->diffInHours(Task::find(2)->done_at))->toBe(3);
});

it('does not mark tasks of other bags', function () {
    Task::factory(3)->create(['bag_id' => 1, 'done_at' => null]);
    Task::factory(3)->create(['done_at' => null]);

    $this->artisan(DoneAllCommand::class)
        ->expectsOutput('All the tasks are marked as done')
        ->assertExitCode(0);

    expect(Task::ofActiveBag()->opened()->count())->toBe(0);
    expect(Task::opened()->count())->toBe(3);
});
