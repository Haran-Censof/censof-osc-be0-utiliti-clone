<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     * Create osc_ind_translesen table for license transaction history
     * This table tracks all transactions for approved licenses (with account numbers)
     */
    public function up(): void
    {
        if (!Schema::hasTable('osc_ind_translesen')) {
            Schema::create('osc_ind_translesen', function (Blueprint $table) {
                $table->id()->comment('Primary Key');
                $table->string('trn_idpbt', 10)->nullable()->comment('ID PBT');
                $table->integer('trn_akaun')->nullable()->comment('NO AKAUN LESEN');
                $table->tinyInteger('trn_sequtama')->nullable()->comment('SEQUENCE UTAMA');
                $table->string('trn_kodjenis', 2)->nullable()->comment('KOD JENIS');
                $table->string('trn_kodsektor', 5)->nullable()->comment('KOD SEKTOR');
                $table->string('trn_kodaktiviti', 5)->nullable()->comment('KOD AKTIVITI');
                $table->string('trn_kodniaga', 12)->nullable()->comment('KOD PERNIAGAAN');
                $table->string('trn_risiko', 1)->nullable()->comment('KATEGORI RISIKO');
                $table->decimal('trn_tmbhkurng', 11, 2)->nullable()->comment('AMAUN TAMBAHAN/KURANGAN');
                $table->string('trn_statcagar', 1)->nullable()->comment('STATUS CAGARAN');
                $table->string('trn_akauncagar', 10)->nullable()->comment('NO AKAUN CAGARAN');
                $table->date('trn_tarikhcagar')->nullable()->comment('TARIKH CAGARAN');
                $table->string('trn_resitcagar', 20)->nullable()->comment('NO RESIT CAGARAN');
                $table->decimal('trn_amauncagar', 11, 2)->nullable()->comment('AMAUN CAGARAN');
                $table->string('trn_stattrans', 1)->nullable()->comment('STATUS TRANSAKSI');
                $table->string('trn_oldcode', 20)->nullable()->comment('KOD LAMA');
                $table->string('trn_nosiri', 20)->nullable()->comment('NO SIRI PERMOHONAN');
                $table->date('trn_idate')->nullable()->comment('TARIKH KEMASUKAN');
                $table->date('trn_udate')->nullable()->comment('TARIKH KEMASKINI');
                $table->string('trn_iuser', 20)->nullable()->comment('NO KP PEGAWAI KEMASUKAN');
                $table->string('trn_uuser', 20)->nullable()->comment('NO KP PEGAWAI KEMASKINI');
                $table->timestamps();

                // Indexes
                $table->index(['trn_idpbt', 'trn_akaun'], 'idx_translesen_pbt_akaun');
                $table->index('trn_kodniaga', 'idx_translesen_kodniaga');
                $table->index('trn_nosiri', 'idx_translesen_nosiri');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('osc_ind_translesen');
    }
};
