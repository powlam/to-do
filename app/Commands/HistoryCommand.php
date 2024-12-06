<?php

namespace App\Commands;

use App\Models\Task;
use Carbon\Carbon;
use LaravelZero\Framework\Commands\Command;

use function Laravel\Prompts\table;

class HistoryCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'history';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Lists every task done (last done first)';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        if (Task::done()->count() === 0) {
            $this->info('Nothing to show');

            return;
        }

        $rows = [];
        foreach (Task::done()->orderBy('done_at', 'desc')->get() as $task) {
            $rows[] = [
                $task->created_at,
                $task->done_at,
                $task->done_at->diffForHumans($task->created_at, ['syntax' => Carbon::DIFF_ABSOLUTE]),
                $task->text,
            ];
        }

        table(
            headers: ['Created', 'Done ▼', 'Time diff', 'Task'],
            rows: $rows
        );
    }
}
