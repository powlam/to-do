<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\Bag;
use Illuminate\Database\Schema\Builder;

final class AddBag
{
    /**
     * Run the action.
     */
    public function handle(string $name, ?string &$error): ?Bag
    {
        if (mb_strlen($name) > Builder::$defaultStringLength) {
            $error = 'Too long: the text exceeds the maximum length of '.Builder::$defaultStringLength.' characters';

            return null;
        }

        if (Bag::where('name', $name)->exists()) {
            $error = 'The bag already exists';

            return null;
        }

        return Bag::create([
            'name' => $name,
            'is_active' => Bag::doesntExist(),
        ]);
    }
}
