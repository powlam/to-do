<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\Bag;

final class DeleteBag
{
    /**
     * Run the action.
     */
    public function handle(int $bag_id, ?string &$error): void
    {
        $bag = Bag::find($bag_id);

        if (! $bag) {
            $error = 'Bag not found';

            return;
        }

        $was_active = $bag->is_active;

        $bag->tasks()->delete();
        $bag->delete();

        if ($was_active) {
            if (Bag::count() > 0) {
                Bag::first()?->setActive();
            } else {
                Bag::create(['name' => 'default', 'is_active' => true]);
            }
        }
    }
}
