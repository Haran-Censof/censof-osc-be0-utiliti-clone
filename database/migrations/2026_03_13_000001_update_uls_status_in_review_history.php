<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Change uls_status from ENUM to VARCHAR to support all status values
        DB::connection('mysql')->statement("ALTER TABLE `osc_mhn_ulasan_review_history` MODIFY `uls_status` VARCHAR(20) COMMENT 'Review status'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert back to ENUM (only if needed)
        DB::connection('mysql')->statement("ALTER TABLE `osc_mhn_ulasan_review_history` MODIFY `uls_status` ENUM('APPROVED', 'REJECTED', 'RESEND', 'SUBMITTED') COMMENT 'Review status'");
    }
};
