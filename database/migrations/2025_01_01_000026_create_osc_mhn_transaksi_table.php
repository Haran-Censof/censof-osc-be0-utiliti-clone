<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('osc_mhn_transaksi', function (Blueprint $table) {
            $table->string('trn_kdsrpbt', 10)->comment('KOD SIRI PBT');
            $table->decimal('trn_nosiri', 9, 0)->comment('NO SIRI PERMOHONAN');
            $table->decimal('trn_akaun', 7, 0)->nullable()->comment('NO AKAUN - LEPAS KELULUSAN');
            $table->decimal('trn_utama', 2, 0)->nullable()->comment('KEUTAMAAN TRANSAKSI');
            $table->string('trn_kodp1', 2)->comment('KOD PERNAGAAN');
            $table->string('trn_kodp2', 3)->comment('KOD PERNIAGAAN');
            $table->string('trn_kodp3', 2)->comment('KOD PERNIAGAAN');
            $table->decimal('trn_tambh', 11, 2)->nullable()->comment('AMAUN TAMBAHAN');
            $table->string('trn_scagr', 1)->nullable()->comment('STATUS DIKENAKAN CAGARAN');
            $table->string('trn_ckaun', 10)->nullable()->comment('NO AKAUN CAGARAN');
            $table->string('trn_statt', 1)->nullable()->comment('STATUS TRANSAKSI');
            $table->dateTime('trn_idate')->nullable()->comment('TARIKH INPUT');
            $table->dateTime('trn_udate')->nullable()->comment('TARIKH KEMASKINI');

            // Add Laravel timestamps
            $table->timestamps();

            // Add composite primary key
            $table->primary(['trn_kdsrpbt', 'trn_nosiri', 'trn_kodp1', 'trn_kodp2', 'trn_kodp3'], 'pk_osc_mhn_transaksi');

            // Add indexes
            $table->index(['trn_kdsrpbt', 'trn_nosiri']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('osc_mhn_transaksi');
    }
};
