<?php

declare(strict_types=1);

use App\Models\Bag;

test('to array', function () {
    $check = Bag::factory()->create()->fresh();

    expect($check->toArray())->toHaveKeys([
        'id',
        'name',
        'is_active',
        'created_at',
        'updated_at',
    ]);
});
