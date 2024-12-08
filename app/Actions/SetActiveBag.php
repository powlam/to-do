<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\Bag;

final class SetActiveBag
{
    /**
     * Run the action.
     */
    public function handle(int $bag_id, ?string &$error): ?Bag
    {
        $bag = Bag::find($bag_id);

        if (! $bag) {
            $error = 'Bag not found';

            return null;
        }

        if (! $bag->is_active) {
            $bag->setActive();
        }

        return $bag;
    }
}
