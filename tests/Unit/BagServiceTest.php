<?php

declare(strict_types=1);

use App\Models\Bag;
use App\Services\BagService;

it('returns the active bag', function () {
    $active_bag = BagService::activeBag();

    expect($active_bag->is_active)->toBe(true);
});

it('refreshes and returns the active bag when changed', function () {
    $active_bag = BagService::activeBag();
    expect($active_bag->id)->toBe(1);

    Bag::factory(3)->create();

    Bag::find(2)->setActive();
    $active_bag = BagService::activeBag();

    expect($active_bag->id)->toBe(2);
});
