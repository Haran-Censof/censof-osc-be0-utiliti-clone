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
        DB::unprepared("
            DROP FUNCTION IF EXISTS get_value_lookup_table;
        ");

        DB::unprepared("
            CREATE FUNCTION get_value_lookup_table(
                idpbt VARCHAR(50),
                jenis VARCHAR(100),
                rujuk VARCHAR(100)
            )
            RETURNS VARCHAR(2000)
            READS SQL DATA
            BEGIN
                DECLARE keter VARCHAR(2000) DEFAULT '-';
                
                SELECT ctl_ctrlnama
                INTO keter
                FROM osc_pelesenan.osc_slg_lookuptable
                WHERE ctl_idpbt = idpbt
                  AND ctl_ctrlgrp = jenis
                  AND ctl_ctrlcode = rujuk
                  AND IFNULL(ctl_ctrlstatus, 'A') = 'A'
                LIMIT 1;
                
                RETURN keter;
            END;
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP FUNCTION IF EXISTS get_value_lookup_table");
    }
};
