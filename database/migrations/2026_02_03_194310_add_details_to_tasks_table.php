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
    Schema::table('tasks', function (Blueprint $table) {
        // Add 'notes' if it doesn't exist
        if (!Schema::hasColumn('tasks', 'notes')) {
            $table->text('notes')->nullable()->after('title');
        }

        // Add 'duration_minutes' if it doesn't exist
        if (!Schema::hasColumn('tasks', 'duration_minutes')) {
            $table->integer('duration_minutes')->default(60)->after('notes');
        }

        // We skip 'time_spent' here because the error says it already exists!
    });
}

public function down(): void
{
    Schema::table('tasks', function (Blueprint $table) {
        $table->dropColumn(['notes', 'duration_minutes']);
    });
}
};
