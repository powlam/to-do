<?php

declare(strict_types=1);

namespace App\Commands;

use App\Actions\MarkAllTasksAsDone;
use LaravelZero\Framework\Commands\Command;

final class DoneAllCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'done:all';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'All the opened tasks are marked as done';

    /**
     * Execute the console command.
     */
    public function handle(MarkAllTasksAsDone $action): void
    {
        $action->handle();

        $this->info('All the tasks are marked as done');
    }
}
