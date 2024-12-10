<?php

declare(strict_types=1);

namespace App\Commands;

use App\Actions\AddTask;
use App\Services\BagService;
use LaravelZero\Framework\Commands\Command;

use function Laravel\Prompts\text;
use function Termwind\render;

final class AddCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'add';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Asks for the task, stores it, and returns its id';

    /**
     * Execute the console command.
     */
    public function handle(AddTask $action): void
    {
        $text = text('Task description');

        $task = $action->handle($text, $error);

        $bag = BagService::activeBag();
        render('
<div class="pt-1">
    <span class="px-1 bg-gray-600 text-white">'.$bag?->description.'</span>
</div>
');

        if (! $task) {
            if ($error) {
                $this->error($error);
            }

            return;
        }

        $this->info('Task added');
        $this->info(sprintf('%d: %s', $task->id, $task->text));
    }
}
