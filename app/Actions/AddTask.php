<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\Task;
use App\Services\BagService;
use Illuminate\Database\Schema\Builder;

final class AddTask
{
    /**
     * Run the action.
     */
    public function handle(string $text, ?string &$error): ?Task
    {
        if (mb_strlen($text) > Builder::$defaultStringLength) {
            $error = 'Too long: the text exceeds the maximum length of '.Builder::$defaultStringLength.' characters';

            return null;
        }

        return Task::create([
            'bag_id' => BagService::activeBag()?->id,
            'text' => $text,
            'done_at' => null,
        ]);
    }
}
