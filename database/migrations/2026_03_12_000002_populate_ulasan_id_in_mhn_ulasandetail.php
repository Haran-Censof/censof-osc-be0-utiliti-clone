<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Populate ulasan_id for existing records
        DB::statement("
            UPDATE osc_mhn_ulasandetail d
            INNER JOIN osc_mhn_ulasan u ON 
                d.uls_idpbt = u.uls_idpbt AND
                d.uls_nosiri = u.uls_nosiri AND
                d.uls_ulsiri = u.uls_ulsiri
            SET d.ulasan_id = u.id
            WHERE d.ulasan_id IS NULL
        ");
    }

    public function down(): void
    {
        // Set ulasan_id back to null
        DB::table('osc_mhn_ulasandetail')->update(['ulasan_id' => null]);
    }
};
