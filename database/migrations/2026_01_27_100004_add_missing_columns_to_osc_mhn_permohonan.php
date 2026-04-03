<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations to add missing columns to OSC_MHN_PERMOHONAN table.
     */
    public function up(): void
    {
        Schema::table('osc_mhn_permohonan', function (Blueprint $table) {
            // Add missing MHN_KODSSM column from Oracle DDL
            $table->string('mhn_kodssm', 20)->nullable()->after('mhn_idpelanggan')->comment('KOD SSM/ROC/ROS');

            // Add index for the new column
            $table->index(['mhn_kodssm'], 'idx_mhn_permohonan_kodssm');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('osc_mhn_permohonan', function (Blueprint $table) {
            $table->dropIndex('idx_mhn_permohonan_kodssm');
            $table->dropColumn('mhn_kodssm');
        });
    }
};
