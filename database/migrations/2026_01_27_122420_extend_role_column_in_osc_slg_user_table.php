<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     * Extends the role column to accommodate longer role names like:
     * - PBT-PENYEMAK (12 chars)
     * - ATL-PENYEMAK (12 chars)
     * - BTD-PENYEMAK (12 chars)
     * - ATL-KETUA-JABATAN (18 chars)
     * - BTD-KETUA-JABATAN (18 chars)
     */
    public function up(): void
    {
        Schema::table('osc_slg_user', function (Blueprint $table) {
            $table->string('role', 30)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('osc_slg_user', function (Blueprint $table) {
            $table->string('role', 10)->nullable()->change();
        });
    }
};
