<?php

declare(strict_types=1);

namespace App\Models;

use App\Services\BagService;
use Database\Factories\TaskFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

final class Task extends Model
{
    /** @use HasFactory<TaskFactory> */
    use HasFactory;

    /**
     * The attributes that should be cast.
     *
     * @var array{done_at: 'datetime'}
     */
    protected $casts = [
        'done_at' => 'datetime',
    ];

    /**
     * Get the bag that owns the task.
     *
     * @return BelongsTo<Bag, Task>
     */
    public function bag(): BelongsTo
    {
        return $this->belongsTo(Bag::class);
    }

    /**
     * Scope a query to only include tasks of the active bag.
     *
     * @param  Builder<Task>  $query
     */
    public function scopeOfActiveBag(Builder $query): void
    {
        $query->where('bag_id', BagService::activeBag()?->id);
    }

    /**
     * Scope a query to only include opened tasks.
     *
     * @param  Builder<Task>  $query
     */
    public function scopeOpened(Builder $query): void
    {
        $query->whereNull('done_at');
    }

    /**
     * Scope a query to only include done tasks.
     *
     * @param  Builder<Task>  $query
     */
    public function scopeDone(Builder $query): void
    {
        $query->whereNotNull('done_at');
    }
}
