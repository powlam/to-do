<?php

declare(strict_types=1);

namespace App\Commands;

use App\Actions\MarkTaskAsDone;
use LaravelZero\Framework\Commands\Command;

final class DoneCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'done {task}';

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

        if (! $marked) {
            if ($error) {
                $this->warn($error);
            }

            return;
        }

        $this->info('Task marked as done');
    }
}
