<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Extend meeting-related foreign key columns to support new scalable format
     * Old format: 6 digits (e.g., 000001)
     * New format: MBSJ/MSY/2025/0000000001 (26 chars)
     * Extend to 50 chars for future-proofing
     */
    public function up(): void
    {
        // Use raw SQL to avoid foreign key constraint issues
        // MySQL allows modifying referenced columns if the change is compatible

        DB::statement('ALTER TABLE `osc_smk_mesyuarat` MODIFY COLUMN `msy_bilangan` VARCHAR(50) NULL');
        DB::statement('ALTER TABLE `meeting_agendas` MODIFY COLUMN `agd_nomesy` VARCHAR(50) NOT NULL');
        DB::statement('ALTER TABLE `meeting_attendees` MODIFY COLUMN `att_nomesy` VARCHAR(50) NOT NULL');
        DB::statement('ALTER TABLE `meeting_minutes` MODIFY COLUMN `mnt_nomesy` VARCHAR(50) NOT NULL');
        DB::statement('ALTER TABLE `meeting_decisions` MODIFY COLUMN `decision_meeting_number` VARCHAR(50) NOT NULL');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert to original lengths
        DB::statement('ALTER TABLE `osc_smk_mesyuarat` MODIFY COLUMN `msy_bilangan` VARCHAR(10) NULL');
        DB::statement('ALTER TABLE `meeting_agendas` MODIFY COLUMN `agd_nomesy` VARCHAR(10) NOT NULL');
        DB::statement('ALTER TABLE `meeting_attendees` MODIFY COLUMN `att_nomesy` VARCHAR(10) NOT NULL');
        DB::statement('ALTER TABLE `meeting_minutes` MODIFY COLUMN `mnt_nomesy` VARCHAR(10) NOT NULL');
        DB::statement('ALTER TABLE `meeting_decisions` MODIFY COLUMN `decision_meeting_number` VARCHAR(20) NOT NULL');
    }
};
