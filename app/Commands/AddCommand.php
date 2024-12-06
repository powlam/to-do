<?php

declare(strict_types=1);

namespace App\Commands;

use App\Actions\AddTask;
use LaravelZero\Framework\Commands\Command;

use function Laravel\Prompts\text;

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
    public function handle(AddTask $action)
    {
        $text = text('Task description');

        $task = $action->handle($text, $error);

        if (! $task) {
            $this->error($error);

            return;
        }

        $this->info('Task added');
        $this->info(sprintf('%d: %s', $task->id, $task->text));
    }
}
