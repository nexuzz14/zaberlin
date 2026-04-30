<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("ALTER TABLE videos MODIFY COLUMN category ENUM('podcast', 'edukasi', 'variety show', 'iklan komersial') NOT NULL");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("ALTER TABLE videos MODIFY COLUMN category ENUM('podcast', 'edukasi') NOT NULL");
    }
};
