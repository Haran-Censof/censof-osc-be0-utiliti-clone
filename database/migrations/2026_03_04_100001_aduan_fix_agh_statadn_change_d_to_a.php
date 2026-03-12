<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     * FIX: Change agh_statadn from [D] to [A] for "Dalam Proses"
     * Reason: [D] is used for adn_stataduan (complaint status)
     *         [A] should be used for agh_statadn (assignment status)
     *         This prevents confusion between complaint-level and assignment-level status
     * 
     * Before: [P]-Baru [D]-Dalam Proses [S]-Selesai
     * After:  [P]-Baru [A]-Dalam Proses [S]-Selesai
     */
    public function up(): void
    {
        // 1. Update existing data: change 'D' to 'A' in agh_statadn
        DB::statement("UPDATE osc_adn_agihan SET agh_statadn = 'A' WHERE agh_statadn = 'D'");
        
        // 2. Update column comment to reflect correct values
        DB::statement("ALTER TABLE osc_adn_agihan MODIFY COLUMN agh_statadn CHAR(1) NULL COMMENT 'STATUS AGIHAN [P]-Baru [A]-Dalam Proses [S]-Selesai'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert: change 'A' back to 'D'
        DB::statement("UPDATE osc_adn_agihan SET agh_statadn = 'D' WHERE agh_statadn = 'A'");
        
        // Revert column comment
        DB::statement("ALTER TABLE osc_adn_agihan MODIFY COLUMN agh_statadn CHAR(1) NULL COMMENT 'STATUS ULASAN [P]-Baru [D]-Dalam Proses [S]-Selesai'");
    }
};
