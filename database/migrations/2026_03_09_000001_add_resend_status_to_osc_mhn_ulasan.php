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
        // Modify ENUM to add RESEND status
        DB::connection('mysql')->statement("ALTER TABLE osc_mhn_ulasan MODIFY COLUMN uls_status ENUM('DRAFT', 'SUBMITTED', 'APPROVED', 'REJECTED', 'RESEND') DEFAULT 'SUBMITTED' COMMENT 'Status ulasan: DRAFT, SUBMITTED, APPROVED, REJECTED, RESEND'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert back to original ENUM values
        DB::connection('mysql')->statement("ALTER TABLE osc_mhn_ulasan MODIFY COLUMN uls_status ENUM('DRAFT', 'SUBMITTED', 'APPROVED', 'REJECTED') DEFAULT 'SUBMITTED' COMMENT 'Status ulasan: DRAFT, SUBMITTED, APPROVED, REJECTED'");
    }
};
