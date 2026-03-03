<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('candidates', function (Blueprint $table) {
            $table->id();

            // Multi-tenant
            $table->foreignId('company_id')
                  ->constrained()
                  ->cascadeOnDelete();

            // Election relation
            $table->foreignId('election_id')
                  ->constrained()
                  ->cascadeOnDelete();

            // Candidate info
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('photo')->nullable();

            $table->integer('vote_count')->default(0);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('candidates');
    }
};