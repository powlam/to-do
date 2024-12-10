<?php

declare(strict_types=1);

use App\Models\Task;

test('to array', function () {
    $check = Task::factory()->create()->fresh();

    expect($check->toArray())->toHaveKeys([
        'id',
        'bag_id',
        'text',
        'created_at',
        'updated_at',
        'done_at',
    ]);
});
