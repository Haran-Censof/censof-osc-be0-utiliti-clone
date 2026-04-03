<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations to fix OSC_MHN_TRANSAKSI structure to match Oracle DDL.
     */
    public function up(): void
    {
        Schema::table('osc_mhn_transaksi', function (Blueprint $table) {
            // Add missing TRN_KODNIAGA column (Oracle has single field, MySQL has split fields)
            $table->string('trn_kodniaga', 12)->nullable()->after('trn_nosiri')->comment('KOD PERNIAGAAN');

            // Add missing TRN_RISIKO column
            $table->char('trn_risiko', 1)->nullable()->after('trn_kodniaga')->comment('STATUS RISIKO');

            // Add indexes for the new columns
            $table->index(['trn_kodniaga'], 'idx_mhn_transaksi_kodniaga');
            $table->index(['trn_risiko'], 'idx_mhn_transaksi_risiko');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('osc_mhn_transaksi', function (Blueprint $table) {
            $table->dropIndex('idx_mhn_transaksi_kodniaga');
            $table->dropIndex('idx_mhn_transaksi_risiko');
            $table->dropColumn(['trn_kodniaga', 'trn_risiko']);
        });
    }
};
