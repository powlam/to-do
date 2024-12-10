<?php

declare(strict_types=1);

namespace App\Commands;

use App\Models\Bag;
use LaravelZero\Framework\Commands\Command;

final class BagsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bags';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Lists all the bags, indicating which is the active one (ordered by bag name)';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        if (Bag::count() === 0) {
            // there must be at least one bag
            Bag::factory()->create(['name' => 'default']);
        }

        foreach (Bag::orderBy('name')->get() as $bag) {
            $this->info(($bag->is_active ? '► ' : '').$bag->description);
        }
    }
}
