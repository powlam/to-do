<?php

declare(strict_types=1);

namespace App\Models;

use App\Services\BagService;
use Database\Factories\BagFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
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

    public function setActive(): void
    {
        self::where('id', '!=', $this->id)->update(['is_active' => false]);
        $this->update(['is_active' => true]);
        BagService::activeBag(refresh: true);
    }

    /**
     * Get the description attribute.
     *
     * @return Attribute<string, null>
     */
    protected function description(): Attribute
    {
        return Attribute::make(
            // @phpstan-ignore-next-line
            get: fn (mixed $value, mixed $attributes) => is_array($attributes) ? sprintf('%d [%s]', $attributes['id'], $attributes['name']) : '',
        );
    }
}
