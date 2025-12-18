<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('osc_cgr_cagaran', function (Blueprint $table) {
            $table->string('cag_idpbt', 10)->comment('ID PBT');
            $table->integer('cag_cagakaun')->comment('NO AKAUN CAGARAN');
            $table->integer('cag_lsnakaun')->comment('NO AKAUN LESEN');
            $table->string('cag_kodniaga1', 2)->comment('KOD PERNIAGAAN1');
            $table->string('cag_kodniaga2', 3)->comment('KOD PERNIAGAAN2');
            $table->string('cag_kodniaga3', 2)->comment('KOD PERNIAGAAN3');
            $table->string('cag_transaksi', 6)->nullable()->comment('KOD TRANSAKSI/KOD HASIL');
            $table->string('cag_norujukan', 20)->nullable()->comment('NO RUJUKAN RESIT/BIL/JERNAL');
            $table->datetime('cag_tkhtrans')->nullable()->comment('TARIKH TRANSAKSI');
            $table->decimal('cag_trnamaun', 13, 2)->nullable()->comment('AMAUN TRANSAKSI');
            $table->string('cag_statf', 1)->nullable()->comment('STATUS TRANSAKSI');
            $table->datetime('cag_idate')->nullable()->comment('TARIKH INPUT');
            $table->datetime('cag_udate')->nullable()->comment('TARIKH KEMASKINI');
            $table->string('cag_iuser', 20)->nullable()->comment('NO KP PEGAWAI KEMASUKAN');
            $table->string('cag_uuser', 20)->nullable()->comment('NO KP PEGAWAI KEMASKINI');
            
            $table->timestamps();
            $table->primary(['cag_idpbt', 'cag_cagakaun', 'cag_lsnakaun', 'cag_kodniaga1', 'cag_kodniaga2', 'cag_kodniaga3']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('osc_cgr_cagaran');
    }
};
