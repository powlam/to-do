<?php

use App\Commands\CheckCommand;
use App\Models\Task;

/* before using RefreshDatabase it was working this way */
// use Illuminate\Support\Facades\Artisan;
// it('works', function () {
//     Artisan::call(DefaultCommand::class);
//     $output = Artisan::output();
//     expect($output)->toContain('Here we are!');
// });

it('returns nothing if there is no task pending', function () {
    $this->artisan(CheckCommand::class)
        ->doesntExpectOutput()
        ->assertExitCode(0);
});

it('lists all the opened tasks', function () {
    Task::factory(3)->create(['done_at' => null]);

    $this->artisan(CheckCommand::class)
        ->expectsOutputToContain(Task::find(1)->text)
        ->expectsOutputToContain(Task::find(2)->text)
        ->expectsOutputToContain(Task::find(3)->text)
        ->assertExitCode(0);

    expect(Task::whereNull('done_at')->count())->toBe(3);
});
