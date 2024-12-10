<?php

declare(strict_types=1);

namespace App\Commands;

use App\Actions\ClearTasks;
use App\Services\BagService;
use LaravelZero\Framework\Commands\Command;

use function Laravel\Prompts\confirm;
use function Termwind\render;

final class ClearCommand extends Command
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
    public function handle(ClearTasks $action): void
    {
        $confirmed = confirm('Are you sure? This will remove every task FOREVER', false);

        $bag = BagService::activeBag();
        render('
<div class="pt-1">
    <span class="px-1 bg-gray-600 text-white">'.$bag?->description.'</span>
</div>
');

        if ($confirmed) {
            $action->handle();
            $this->info('All the tasks have been removed');
        } else {
            $this->info('Nothing done');
        }
    }
}
