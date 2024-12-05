<?php

namespace App\Commands;

use LaravelZero\Framework\Commands\Command;

class DefaultCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'default';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This is the default command that will be executed';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Here we are!');
    }
}
