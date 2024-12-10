<?php

declare(strict_types=1);

namespace App\Commands;

use App\Actions\MarkTaskAsDone;
use App\Services\BagService;
use LaravelZero\Framework\Commands\Command;

use function Termwind\render;

final class DoneCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'done {task : ID of the task}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'The task is marked as done';

    /**
     * Execute the console command.
     */
    public function handle(MarkTaskAsDone $action): void
    {
        $marked = $action->handle((int) $this->argument('task'), $error);

        $bag = BagService::activeBag();
        render('
<div class="pt-1">
    <span class="px-1 bg-gray-600 text-white">'.$bag?->description.'</span>
</div>
');

        if (! $marked) {
            if ($error) {
                $this->warn($error);
            }

            return;
        }

        $this->info('Task marked as done');
    }
}
