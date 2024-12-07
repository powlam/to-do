<?php

declare(strict_types=1);

use App\Commands\CheckCommand;
use App\Models\Task;

/* before using RefreshDatabase it was working this way */
// use Illuminate\Support\Facades\Artisan;
// it('works', function () {
//     Task::factory(3)->create(['done_at' => null]);

//     Artisan::call(CheckCommand::class);
//     $output = Artisan::output();
//     expect($output)->toContain(Task::find(1)->text);
// });

it('returns nothing if there is no tasks', function () {
    $this->artisan(CheckCommand::class)
        ->doesntExpectOutput()
        ->assertExitCode(0);
});

it('returns nothing if all the tasks are marked as done', function () {
    Task::factory(3)->create();

    $this->artisan(CheckCommand::class)
        ->doesntExpectOutput()
        ->assertExitCode(0);
});

it('lists all the opened tasks', function () {
    Task::factory(3)->create(['bag_id' => 1, 'done_at' => null]);

    $this->artisan(CheckCommand::class)
        ->expectsOutputToContain(Task::find(1)->text)
        ->expectsOutputToContain(Task::find(2)->text)
        ->expectsOutputToContain(Task::find(3)->text)
        ->assertExitCode(0);

    expect(Task::whereNull('done_at')->count())->toBe(3);
});

it('does not show tasks of other bags', function () {
    Task::factory(3)->create(['bag_id' => 1, 'done_at' => null]);
    Task::factory()->create(['done_at' => null]);

    $this->artisan(CheckCommand::class)
        ->doesntExpectOutputToContain(Task::find(4)->text)
        ->assertExitCode(0);
});
