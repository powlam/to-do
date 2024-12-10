<?php

declare(strict_types=1);

namespace App\Commands;

use App\Actions\DeleteBag;
use App\Models\Bag;
use LaravelZero\Framework\Commands\Command;

use function Laravel\Prompts\confirm;

final class BagDeleteCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bag:delete {bag?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Deletes a bag; if no bag is provided, the active bag is used';

    /**
     * Execute the console command.
     */
    public function handle(DeleteBag $action): void
    {
        $confirmed = confirm('Are you sure? This will remove FOREVER the bag', false);

        if ($confirmed) {
            $active_bag_id = Bag::active()->first()?->id;
            $bag_id = (int) ($this->argument('bag') ?: $active_bag_id);

            $action->handle($bag_id, $error);

            if ($error) {
                $this->error($error);

                return;
            }

            $this->info('Bag deleted');

            if ($active_bag_id === $bag_id) {
                $new_active_bag = Bag::active()->first();
                if ($new_active_bag) {
                    $this->info('The active bag is now '.$new_active_bag->description);
                }
            }
        } else {
            $this->info('Nothing done');
        }
    }
}
