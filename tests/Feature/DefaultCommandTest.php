<?php

use App\Commands\DefaultCommand;

it('works', function () {
    /* before using RefreshDatabase it was working this way */
    // use Illuminate\Support\Facades\Artisan;
    // Artisan::call(DefaultCommand::class);
    // $output = Artisan::output();
    // expect($output)->toContain('Here we are!');

    $this->artisan(DefaultCommand::class)
        ->expectsOutput('Here we are!')
        ->assertExitCode(0);
});
