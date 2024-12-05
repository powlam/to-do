<?php

namespace App\Actions;

use App\Models\Task;

final class MarkAllTasksAsDone
{
    /**
     * Run the action.
     */
    public function handle(): void
    {
        Task::opened()->update([
            'done_at' => now(),
        ]);
    }
}
