<?php

declare(strict_types=1);

namespace App\Commands;

use App\Models\Task;
use LaravelZero\Framework\Commands\Command;

use function Termwind\render;

final class CheckCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Returns a list of opened to-do's (oldest first)";

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        if (Task::opened()->count() === 0) {
            return;
        }

        render(<<<'HTML'
            <div class="py-1 ml-2">
                <div class="px-1 bg-green-300 text-black">There are pending tasks</div>
            </div>
        HTML);

        foreach (Task::opened()->get() as $task) {
            $this->info(sprintf('%d: %s', $task->id, $task->text));
        }
    }
}
