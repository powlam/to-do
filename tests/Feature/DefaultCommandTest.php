<?php

use App\Commands\DefaultCommand;
use Illuminate\Support\Facades\Artisan;

it('works', function () {
    Artisan::call(DefaultCommand::class);

    $output = Artisan::output();

    expect($output)->toContain('Here we are!');
});
