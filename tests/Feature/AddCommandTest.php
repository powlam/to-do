<?php

use App\Commands\AddCommand;
use App\Models\Task;
use Illuminate\Database\Schema\Builder;
use Illuminate\Support\Str;

it('does nothing if the text is too long', function () {
    $this->artisan(AddCommand::class)
        ->expectsQuestion('Task description', Str::random(Builder::$defaultStringLength + 1))
        ->expectsOutputToContain('Too long')
        ->assertExitCode(0);

    expect(Task::count())->toBe(0);
});

it('adds a task', function () {
    $this->artisan(AddCommand::class)
        ->expectsQuestion('Task description', 'The new task')
        ->expectsOutputToContain('Task added')
        ->expectsOutputToContain('The new task')
        ->assertExitCode(0);

    expect(Task::count())->toBe(1);
});
