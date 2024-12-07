<?php

declare(strict_types=1);

use App\Models\Bag;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Bag::class);
            $table->string('text');
            $table->timestamps();
            $table->dateTime('done_at')->nullable();
        });
    }
};
