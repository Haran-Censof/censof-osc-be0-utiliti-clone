<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('osc_bil_translesen', function (Blueprint $table) {
            $table->string('bl2_idpbt', 10)->nullable()->comment('KOD ID PBT');
            $table->integer('bl2_noakaun')->nullable()->comment('NO AKAUN');
            $table->string('bl2_transaksi', 5)->nullable()->comment('KOD TRANSAKSI/HASIL');
            $table->string('bl2_nombil', 15)->nullable()->comment('NO BIL LESEN');
            $table->decimal('bl2_amaun', 11, 2)->nullable()->comment('AMAUN BIL');
            $table->string('bl2_statf', 1)->nullable()->comment('STATUS BIL [N]-BARU [P]-CETAKAN SEMULA');
            $table->datetime('bl2_idate')->nullable()->comment('TARIKH KEMASUKAN');
            $table->datetime('bl2_udate')->nullable()->comment('TARIKH KEMASKINI');
            $table->string('bl2_iuser', 20)->nullable()->comment('NO KP PEGAWAI KEMASUKAN');
            $table->string('bl2_uuser', 20)->nullable()->comment('NO KP PEGAWAI KEMASKINI');
            
            $table->timestamps();
            $table->index(['bl2_idpbt', 'bl2_noakaun']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('osc_bil_translesen');
    }
};
