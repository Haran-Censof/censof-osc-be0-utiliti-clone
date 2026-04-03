<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations to create OSC_HST_PENYATA table.
     * Based on Oracle DDL: PENYATA AKAUN INDIVIDU
     */
    public function up(): void
    {
        Schema::create('osc_hst_penyata', function (Blueprint $table) {
            // Primary fields based on Oracle DDL
            $table->id();
            $table->string('pyt_idpbt', 10)->nullable()->comment('KOD ID PBT');
            $table->integer('pyt_akaun')->comment('NO AKAUN'); // NOT NULL in Oracle
            $table->string('pyt_transaksi', 6)->nullable()->comment('KOD TRAKSAKSI/KOD HASIL');
            $table->string('pyt_noresit', 20)->nullable()->comment('NO RESIT');
            $table->date('pyt_tkhresit')->nullable()->comment('TARIKH RESIT');
            $table->decimal('pyt_amnresit', 11, 2)->nullable()->comment('AMAUN RESIT');
            $table->char('pyt_statf', 1)->nullable()->comment('STATUS FAIL');
            $table->string('pyt_rujukan', 7)->nullable()->comment('NO RUJUKAN KEWANGAN');
            $table->date('pyt_udate')->nullable()->comment('TARIKH KEMASKINI');
            $table->string('pyt_uuser', 20)->nullable()->comment('NO KP PEGAWAI KEMASKINI');

            // Laravel timestamps (optional - can be removed if not needed)
            $table->timestamps();

            // Indexes for performance
            $table->index(['pyt_idpbt'], 'idx_hst_penyata_pbt');
            $table->index(['pyt_akaun'], 'idx_hst_penyata_akaun');
            $table->index(['pyt_transaksi'], 'idx_hst_penyata_transaksi');
            $table->index(['pyt_tkhresit'], 'idx_hst_penyata_tarikh');
            $table->index(['pyt_statf'], 'idx_hst_penyata_status');
        });

        // Add table comment
        DB::statement("ALTER TABLE `osc_hst_penyata` COMMENT = 'PENYATA AKAUN INDIVIDU'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('osc_hst_penyata');
    }
};
