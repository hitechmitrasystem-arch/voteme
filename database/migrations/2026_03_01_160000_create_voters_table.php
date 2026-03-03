<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('voters', function (Blueprint $table) {
            $table->id(); // BIGINT UNSIGNED (matches foreign keys)

            // Multi-tenant company relation
            $table->foreignId('company_id')
                  ->constrained()
                  ->cascadeOnDelete();

            // Public voter login ID (like VTR12345)
            $table->string('voter_id')->unique();

            $table->string('name');
            $table->string('email')->nullable();

            // Hashed password
            $table->string('password');

            $table->boolean('is_active')->default(true);
            $table->boolean('must_change_password')->default(true);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('voters');
    }
};