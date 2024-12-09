<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\Bag;
use Illuminate\Database\Schema\Builder;

final class RenameBag
{
    /**
     * Run the action.
     */
    public function handle(int $bag_id, string $name, ?string &$error): ?Bag
    {
        if (mb_strlen($name) > Builder::$defaultStringLength) {
            $error = 'Too long: the text exceeds the maximum length of '.Builder::$defaultStringLength.' characters';

            return null;
        }

        if (Bag::where('name', $name)->exists()) {
            $error = 'The bag already exists';

            return null;
        }

        $bag = Bag::find($bag_id);

        if (! $bag) {
            $error = 'Bag not found';

            return null;
        }

        $bag->name = $name;
        $bag->save();

        return $bag;
    }
}
