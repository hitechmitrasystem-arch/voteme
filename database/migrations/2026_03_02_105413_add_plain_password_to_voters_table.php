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
        // Check if column does not already exist
        if (!Schema::hasColumn('voters', 'plain_password')) {
            Schema::table('voters', function (Blueprint $table) {
                $table->string('plain_password')->nullable()->after('password');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Check before dropping (safe rollback)
        if (Schema::hasColumn('voters', 'plain_password')) {
            Schema::table('voters', function (Blueprint $table) {
                $table->dropColumn('plain_password');
            });
        }
    }
};