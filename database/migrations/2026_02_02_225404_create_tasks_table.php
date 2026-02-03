<?php

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
            $table->timestamps();
            // 1. Link the task to a User
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            // 2. Task Title
            $table->string('title');
            // 3. Task Description
            $table->text('description')->nullable();
            // 4. Task Completion Status
            $table->boolean('is_completed')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
