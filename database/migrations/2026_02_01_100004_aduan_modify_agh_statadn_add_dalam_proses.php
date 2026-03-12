<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Before: [P]-Baru, [S]-Selesai
     * After:  [P]-Baru, [D]-Dalam Proses, [S]-Selesai
     * Reason: SRS UC-PL-AD-PA-04 (Agih dan Jejak Tiket) requires tracking
     * officer assignment lifecycle. Two states are insufficient.
     */
    public function up(): void
    {
        DB::statement("ALTER TABLE osc_adn_agihan MODIFY COLUMN agh_statadn CHAR(1) NULL COMMENT 'STATUS ULASAN [P]-Baru [D]-Dalam Proses [S]-Selesai'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("ALTER TABLE osc_adn_agihan MODIFY COLUMN agh_statadn CHAR(1) NULL COMMENT 'STATUS ULASAN [P]-BARU [S]-SELESAI'");
    }
};
