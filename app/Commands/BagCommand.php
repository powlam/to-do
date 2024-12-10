<?php

declare(strict_types=1);

namespace App\Commands;

use App\Actions\SetActiveBag;
use LaravelZero\Framework\Commands\Command;

final class BagCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bag {bag : ID of the bag}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sets the bag as active';

    /**
     * Execute the console command.
     */
    public function handle(SetActiveBag $action): void
    {
        $bag = $action->handle((int) $this->argument('bag'), $error);

        if (! $bag || $error) {
            if ($error) {
                $this->error($error);
            }

            return;
        }

        $this->info('Bag '.$bag->description.' is now active');
    }
}
