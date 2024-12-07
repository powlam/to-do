<?php

declare(strict_types=1);

namespace App\Models;

use Database\Factories\TaskFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
