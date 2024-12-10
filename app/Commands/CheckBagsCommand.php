<?php

declare(strict_types=1);

namespace App\Commands;

use App\Models\Bag;
use LaravelZero\Framework\Commands\Command;

final class CheckBagsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:bags';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Checks each bag to know if they have opened tasks';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        foreach (Bag::with('tasks')->orderBy('name')->get() as $bag) {
            if ($bag->tasks()->opened()->count() === 0) {
                $this->info(sprintf('%sBag %s is up to date', ($bag->is_active ? '► ' : ''), $bag->description));
            } else {
                $this->warn(sprintf('%sBag %s has pending tasks', ($bag->is_active ? '► ' : ''), $bag->description));
            }
        }
    }
}
