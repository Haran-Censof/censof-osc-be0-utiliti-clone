<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations to update osc_ind_translesen to the latest Oracle structure.
     */
    public function up(): void
    {
        Schema::table('osc_ind_translesen', function (Blueprint $table) {
            // Add missing fields from Oracle structure
            
            // trn_kodjenis - KOD JENIS
            if (!Schema::hasColumn('osc_ind_translesen', 'trn_kodjenis')) {
                $table->string('trn_kodjenis', 2)->nullable()->after('trn_sequtama')->comment('KOD JENIS');
            }
            
            // trn_kodsektor - KOD SEKTOR
            if (!Schema::hasColumn('osc_ind_translesen', 'trn_kodsektor')) {
                $table->string('trn_kodsektor', 5)->nullable()->after('trn_kodjenis')->comment('KOD SEKTOR');
            }
            
            // trn_kodaktiviti - KOD AKTIVITI
            if (!Schema::hasColumn('osc_ind_translesen', 'trn_kodaktiviti')) {
                $table->string('trn_kodaktiviti', 5)->nullable()->after('trn_kodsektor')->comment('KOD AKTIVITI');
            }
            
            // trn_kodniaga - KOD PERNIAGAAN (single field instead of trn_kodniaga1/2/3)
            if (!Schema::hasColumn('osc_ind_translesen', 'trn_kodniaga')) {
                $table->string('trn_kodniaga', 12)->nullable()->after('trn_kodaktiviti')->comment('KOD PERNIAGAAN');
            }
            
            // trn_risiko - RISIKO
            if (!Schema::hasColumn('osc_ind_translesen', 'trn_risiko')) {
                $table->string('trn_risiko', 1)->nullable()->after('trn_kodniaga')->comment('RISIKO');
            }
            
            // trn_tarikhcagar - TARIKH CAGARAN
            if (!Schema::hasColumn('osc_ind_translesen', 'trn_tarikhcagar')) {
                $table->date('trn_tarikhcagar')->nullable()->after('trn_akauncagar')->comment('TARIKH CAGARAN');
            }
            
            // trn_resitcagar - RESIT CAGARAN
            if (!Schema::hasColumn('osc_ind_translesen', 'trn_resitcagar')) {
                $table->string('trn_resitcagar', 20)->nullable()->after('trn_tarikhcagar')->comment('RESIT CAGARAN');
            }
            
            // trn_amauncagar - AMAUN CAGARAN
            if (!Schema::hasColumn('osc_ind_translesen', 'trn_amauncagar')) {
                $table->decimal('trn_amauncagar', 11, 2)->nullable()->after('trn_resitcagar')->comment('AMAUN CAGARAN');
            }
        });
        
        // Note: The old fields trn_kodniaga1, trn_kodniaga2, trn_kodniaga3 can be dropped in a future migration
        // once data migration is complete
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('osc_ind_translesen', function (Blueprint $table) {
            // Remove the fields we added
            
            if (Schema::hasColumn('osc_ind_translesen', 'trn_kodjenis')) {
                $table->dropColumn('trn_kodjenis');
            }
            
            if (Schema::hasColumn('osc_ind_translesen', 'trn_kodsektor')) {
                $table->dropColumn('trn_kodsektor');
            }
            
            if (Schema::hasColumn('osc_ind_translesen', 'trn_kodaktiviti')) {
                $table->dropColumn('trn_kodaktiviti');
            }
            
            if (Schema::hasColumn('osc_ind_translesen', 'trn_kodniaga')) {
                $table->dropColumn('trn_kodniaga');
            }
            
            if (Schema::hasColumn('osc_ind_translesen', 'trn_risiko')) {
                $table->dropColumn('trn_risiko');
            }
            
            if (Schema::hasColumn('osc_ind_translesen', 'trn_tarikhcagar')) {
                $table->dropColumn('trn_tarikhcagar');
            }
            
            if (Schema::hasColumn('osc_ind_translesen', 'trn_resitcagar')) {
                $table->dropColumn('trn_resitcagar');
            }
            
            if (Schema::hasColumn('osc_ind_translesen', 'trn_amauncagar')) {
                $table->dropColumn('trn_amauncagar');
            }
        });
    }
};