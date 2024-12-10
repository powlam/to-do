<?php

declare(strict_types=1);

namespace App\Commands;

use App\Actions\RenameBag;
use App\Models\Bag;
use LaravelZero\Framework\Commands\Command;

use function Laravel\Prompts\text;

final class BagRenameCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bag:rename {bag? : ID of the bag}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Renames a bag; if no bag is provided, the active bag is used';

    /**
     * Execute the console command.
     */
    public function handle(RenameBag $action): void
    {
        $name = text('Bag name');

        $bag_id = (int) ($this->argument('bag') ?: Bag::where('is_active', true)->first()?->id);
        $bag = $action->handle($bag_id, $name, $error);

        if (! $bag || $error) {
            if ($error) {
                $this->error($error);
            }

            return;
        }

        $this->info('Bag renamed');
        $this->info($bag->description);
    }
}
