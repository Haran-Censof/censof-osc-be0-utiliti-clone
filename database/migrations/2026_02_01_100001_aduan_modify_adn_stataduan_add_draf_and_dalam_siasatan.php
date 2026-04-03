<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     
     * Before: [P]-Permohonan, [S]-Selesai
     * After:  [X]-Draf, [P]-Baru, [D]-Dalam Siasatan, [S]-Selesai
     * 
     * Status workflow:
     * [X] Draf - System on <Simpan> (Save as draft)
     * [P] Baru - System on <Simpan & Hantar> (Save and Submit)
     * [D] Dalam Siasatan - Officer on accept
     * [S] Selesai - Officer on close
     * 
     * Reason: SRS UC-PA-01-03 requires priority and SLA tracking.
     * The workflow needs draft state and mid-state between new and resolved.
     */
    public function up(): void
    {
        DB::statement("ALTER TABLE osc_adn_indaduan MODIFY COLUMN adn_stataduan CHAR(1) NULL COMMENT 'STATUS ADUAN [X]-Draf [P]-Baru [D]-Dalam Siasatan [S]-Selesai'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("ALTER TABLE osc_adn_indaduan MODIFY COLUMN adn_stataduan CHAR(1) NULL COMMENT 'STATUS ADUAN [P]-PERMOHONAN [S]-SELESAI'");
    }
};
