<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     * Add missing columns to osc_ind_translesen table
     */
    public function up(): void
    {
        Schema::table('osc_ind_translesen', function (Blueprint $table) {
            $table->string('trn_kodjenis', 2)->nullable()->after('trn_sequtama')->comment('KOD JENIS');
            $table->string('trn_kodsektor', 5)->nullable()->after('trn_kodjenis')->comment('KOD SEKTOR');
            $table->string('trn_kodaktiviti', 5)->nullable()->after('trn_kodsektor')->comment('KOD AKTIVITI');
            $table->string('trn_kodniaga', 12)->nullable()->after('trn_kodaktiviti')->comment('KOD PERNIAGAAN');
            $table->string('trn_risiko', 1)->nullable()->after('trn_kodniaga')->comment('KATEGORI RISIKO');
            $table->date('trn_tarikhcagar')->nullable()->after('trn_akauncagar')->comment('TARIKH CAGARAN');
            $table->string('trn_resitcagar', 20)->nullable()->after('trn_tarikhcagar')->comment('NO RESIT CAGARAN');
            $table->decimal('trn_amauncagar', 11, 2)->nullable()->after('trn_resitcagar')->comment('AMAUN CAGARAN');
            $table->string('trn_nosiri', 20)->nullable()->after('trn_oldcode')->comment('NO SIRI PERMOHONAN');
            
            $table->index('trn_kodniaga', 'idx_translesen_kodniaga');
            $table->index('trn_nosiri', 'idx_translesen_nosiri');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('osc_ind_translesen', function (Blueprint $table) {
            $table->dropIndex(['trn_kodniaga']);
            $table->dropIndex(['trn_nosiri']);
            
            $table->dropColumn([
                'trn_kodjenis',
                'trn_kodsektor',
                'trn_kodaktiviti',
                'trn_kodniaga',
                'trn_risiko',
                'trn_tarikhcagar',
                'trn_resitcagar',
                'trn_amauncagar',
                'trn_nosiri'
            ]);
        });
    }
};
