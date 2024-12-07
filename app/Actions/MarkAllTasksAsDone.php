<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\Task;

final class MarkAllTasksAsDone
{
    /**
     * Run the action.
     */
    public function handle(): void
    {
        Task::ofActiveBag()->opened()->update([
            'done_at' => now(),
        ]);
    }
}
