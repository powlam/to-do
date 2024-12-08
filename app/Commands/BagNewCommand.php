<?php

declare(strict_types=1);

namespace App\Commands;

use App\Actions\AddBag;
use LaravelZero\Framework\Commands\Command;

use function Laravel\Prompts\text;

final class BagNewCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bag:new';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates a new bag';

    /**
     * Execute the console command.
     */
    public function handle(AddBag $action): void
    {
        $name = text('Bag name');

        $bag = $action->handle($name, $error);

        if (! $bag) {
            if ($error) {
                $this->error($error);
            }

            return;
        }

        $this->info('Bag created');
        $this->info(sprintf('%d: %s', $bag->id, $bag->name));
    }
}
