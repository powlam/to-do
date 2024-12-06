<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts()
    {
        return [
            'done_at' => 'datetime',
        ];
    }

    /**
     * Scope a query to only include opened tasks.
     */
    public function scopeOpened(Builder $query): void
    {
        $query->whereNull('done_at');
    }

    /**
     * Scope a query to only include done tasks.
     */
    public function scopeDone(Builder $query): void
    {
        $query->whereNotNull('done_at');
    }
}
