<?php

namespace App\Actions;

use App\Models\Task;

final class MarkTaskAsDone
{
    /**
     * Run the action.
     *
     * @return bool The task has been marked?
     */
    public function handle(int $task_id, ?string &$error): bool
    {
        $task = Task::find($task_id);
        if (! $task) {
            $error = 'The task does not exist';

            return false;
        }

        if ($task->done_at) {
            $error = 'The task is already marked as done';

            return false;
        }

        $task->update([
            'done_at' => now(),
        ]);

        return true;
    }
}
