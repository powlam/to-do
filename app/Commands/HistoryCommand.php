<?php

declare(strict_types=1);

namespace App\Commands;

use App\Models\Task;
use App\Services\BagService;
use Carbon\Carbon;
use LaravelZero\Framework\Commands\Command;

use function Laravel\Prompts\table;
use function Termwind\render;

final class HistoryCommand extends Command
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
    public function handle(): void
    {
        $bag = BagService::activeBag();
        render('
<div class="pt-1">
    <span class="px-1 bg-gray-600 text-white">'.$bag?->description.'</span>
</div>
');

        if (Task::ofActiveBag()->done()->count() === 0) {
            $this->info('Nothing to show');

            return;
        }

        $rows = [];
        foreach (Task::ofActiveBag()->done()->orderBy('done_at', 'desc')->get() as $task) {
            $rows[] = [
                $task->created_at?->format('Y-m-d H:i:s') ?? '',
                $task->done_at?->format('Y-m-d H:i:s') ?? '',
                (($task->created_at && $task->done_at) ? $task->done_at->diffForHumans($task->created_at, ['syntax' => Carbon::DIFF_ABSOLUTE]) : ''),
                $task->text,
            ];
        }

        table(
            headers: ['Created', 'Done ▼', 'Time diff', 'Task'],
            rows: $rows
        );
    }
}
