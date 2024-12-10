<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Bag;
use Illuminate\Support\Facades\Cache;

final class BagService
{
    public static function activeBag(bool $refresh = false): ?Bag
    {
        if ($refresh) {
            Cache::forget('active-bag');
        }

        /** @var ?Bag $bag */
        $bag = Cache::remember('active-bag', null, function () {
            return Bag::active()->first();
        });

        return $bag;
    }
}
