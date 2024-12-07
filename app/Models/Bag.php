<?php

declare(strict_types=1);

namespace App\Models;

use Database\Factories\BagFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

final class Bag extends Model
{
    /** @use HasFactory<BagFactory> */
    use HasFactory;

    public $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Get the tasks for the bag.
     *
     * @return HasMany<Task>
     */
    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }

    /**
     * Scope a query to only include active bags.
     *
     * @param  Builder<Bag>  $query
     */
    public function scopeActive(Builder $query): void
    {
        $query->where('is_active', true);
    }
}
