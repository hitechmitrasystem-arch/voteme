<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('elections', function (Blueprint $table) {
            $table->id();

            $table->foreignId('company_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('title');
            $table->text('description')->nullable();

            $table->timestamp('start_time');
            $table->timestamp('end_time');

            // Number of candidates voter can select
            $table->unsignedInteger('max_choices')->default(1);

            // Election control flags
            $table->boolean('is_active')->default(false);
            $table->boolean('is_locked')->default(false);

            $table->timestamps();

            // Ensure end_time is after start_time at DB level (optional safety)
            $table->index(['company_id', 'is_active']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('elections');
    }
};