<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Ensure osc_mhn_permohonan.mhn_idpbt references osc_kod_majlis.maj_idpbt
     */
    public function up(): void
    {
        // Drop existing foreign key if it exists
        Schema::table('osc_mhn_permohonan', function (Blueprint $table) {
            // Try to drop the foreign key if it exists
            try {
                $table->dropForeign(['mhn_idpbt']);
            } catch (\Exception $e) {
                // Foreign key doesn't exist, continue
            }
        });

        // Add the foreign key constraint to reference maj_idpbt
        Schema::table('osc_mhn_permohonan', function (Blueprint $table) {
            $table->foreign('mhn_idpbt')
                  ->references('maj_idpbt')
                  ->on('osc_kod_majlis')
                  ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('osc_mhn_permohonan', function (Blueprint $table) {
            $table->dropForeign(['mhn_idpbt']);
        });
    }
};