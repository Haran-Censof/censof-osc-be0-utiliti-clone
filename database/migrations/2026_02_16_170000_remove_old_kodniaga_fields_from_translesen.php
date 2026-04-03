<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations to remove old trn_kodniaga1/2/3 fields.
     */
    public function up(): void
    {
        Schema::table('osc_ind_translesen', function (Blueprint $table) {
            // Remove old kodniaga fields (replaced by trn_kodniaga)
            if (Schema::hasColumn('osc_ind_translesen', 'trn_kodniaga1')) {
                $table->dropColumn('trn_kodniaga1');
            }
            
            if (Schema::hasColumn('osc_ind_translesen', 'trn_kodniaga2')) {
                $table->dropColumn('trn_kodniaga2');
            }
            
            if (Schema::hasColumn('osc_ind_translesen', 'trn_kodniaga3')) {
                $table->dropColumn('trn_kodniaga3');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('osc_ind_translesen', function (Blueprint $table) {
            // Restore old kodniaga fields
            if (!Schema::hasColumn('osc_ind_translesen', 'trn_kodniaga1')) {
                $table->string('trn_kodniaga1', 2)->nullable()->after('trn_kodaktiviti')->comment('KOD PERNAGAAN 1');
            }
            
            if (!Schema::hasColumn('osc_ind_translesen', 'trn_kodniaga2')) {
                $table->string('trn_kodniaga2', 3)->nullable()->after('trn_kodniaga1')->comment('KOD PERNIAGAAN 2');
            }
            
            if (!Schema::hasColumn('osc_ind_translesen', 'trn_kodniaga3')) {
                $table->string('trn_kodniaga3', 2)->nullable()->after('trn_kodniaga2')->comment('KOD PERNIAGAAN 3');
            }
        });
    }
};