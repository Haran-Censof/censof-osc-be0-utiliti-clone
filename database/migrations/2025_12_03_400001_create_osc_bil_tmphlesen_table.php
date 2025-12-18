<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('osc_bil_tmphlesen', function (Blueprint $table) {
            $table->string('bl1_idpbt', 10)->nullable()->comment('KOD ID PBT');
            $table->integer('bl1_noakaun')->nullable()->comment('NO AKAUN LESEN');
            $table->string('bl1_nombil', 15)->nullable()->comment('NO BIL LESEN');
            $table->datetime('bl1_tkhbil')->nullable()->comment('TARIKH BIL');
            $table->datetime('bl1_tempoh')->nullable()->comment('TEMPOH BIL');
            $table->string('bl1_statf', 1)->nullable()->comment('STATUS BIL [N]-BARU [P]-CETAKAN SEMULA');
            $table->datetime('bl1_idate')->nullable()->comment('TARIKH KEMASUKAN');
            $table->datetime('bl1_udate')->nullable()->comment('TARIKH KEMASKINI');
            $table->string('bl1_iuser', 20)->nullable()->comment('NO KP PEGAWAI KEMASUKAN');
            $table->string('bl1_uuser', 20)->nullable()->comment('NO KP PEGAWAI KEMASKINI');
            
            $table->timestamps();
            $table->index(['bl1_idpbt', 'bl1_noakaun']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('osc_bil_tmphlesen');
    }
};
