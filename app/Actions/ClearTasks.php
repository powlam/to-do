<?php

namespace App\Actions;

use App\Models\Task;

final class ClearTasks
{
    /**
     * Run the action.
     */
    public function handle(): void
    {
        Task::truncate();
    }
}
