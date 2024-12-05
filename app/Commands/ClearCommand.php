<?php

namespace App\Commands;

use App\Actions\ClearTasks;
use LaravelZero\Framework\Commands\Command;

use function Laravel\Prompts\confirm;

class ClearCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Removes every task';

    /**
     * Execute the console command.
     */
    public function handle(ClearTasks $action)
    {
        $confirmed = confirm('Are you sure? This will remove every task FOREVER', false);

        if ($confirmed) {
            $action->handle();
            $this->info('All the tasks have been removed');
        } else {
            $this->info('Nothing done');
        }
    }
}
