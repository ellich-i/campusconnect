<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();

            // RESTRICT = cannot delete a user/category/location that still has events
            $table->foreignId('organizer_id')->constrained('users')->restrictOnDelete();
            $table->foreignId('category_id')->constrained('categories')->restrictOnDelete();
            $table->foreignId('location_id')->constrained('locations')->restrictOnDelete();

            $table->string('title', 150);
            $table->text('description');
            $table->date('event_date');
            $table->time('start_time');
            $table->time('end_time');
            $table->unsignedInteger('capacity');
            $table->string('status', 20)->default('open');
            $table->timestamps();

            // Index for the discovery page: "upcoming open events, sorted by date"
            $table->index(['event_date', 'status']);
            // Postgres does not auto-index foreign keys, so index the filter column
            $table->index('category_id');
        });

        // Database-level rules (second lock behind Laravel validation)
        DB::statement('ALTER TABLE events ADD CONSTRAINT events_capacity_check CHECK (capacity > 0)');
        DB::statement('ALTER TABLE events ADD CONSTRAINT events_time_check CHECK (end_time > start_time)');
        DB::statement("ALTER TABLE events ADD CONSTRAINT events_status_check CHECK (status IN ('open', 'cancelled', 'completed'))");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
