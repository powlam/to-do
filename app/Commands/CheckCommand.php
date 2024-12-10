<?php

declare(strict_types=1);

namespace App\Commands;

use App\Models\Task;
use App\Services\BagService;
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
        if (Task::ofActiveBag()->opened()->count() === 0) {
            return;
        }

        $bag = BagService::activeBag();
        render('
<div class="pt-1">
    <span class="px-1 bg-gray-600 text-white">'.$bag?->description.'</span>
    <span class="px-1 bg-green-300 text-black">There are pending tasks</span>
</div>
');

        foreach (Task::ofActiveBag()->opened()->get() as $task) {
            $this->info(sprintf('%d: %s', $task->id, $task->text));
        }
    }
}
