<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('osc_smk_mesyuarat', function (Blueprint $table) {
            $table->id('id')->comment('Primary Key');
            $table->string('msy_idpbt', 10)->nullable()->comment('KOD SIRI ID PBT');
            $table->string('msy_bilangan', 10)->comment('BILANGAN MESYUARAT');
            $table->date('msy_tkhmesyuarat')->nullable()->comment('TARIKH MESYUARAT OSC');
            $table->string('msy_bulan', 2)->nullable()->comment('BULAN');
            $table->string('msy_kertaskerja', 20)->nullable()->comment('NO KERTAS KERJA');
            $table->string('msy_statf', 1)->nullable()->comment('STATUS MESYUARAT [B]-BELUM SELESAI [S]-SELESAI');
            $table->date('msy_idate')->nullable()->comment('TARIKH KEMASUKAN');
            $table->date('msy_udate')->nullable()->comment('TARIKH KEMASKINI');
            $table->string('msy_iuser', 20)->nullable()->comment('NO KP PEGAWAI KEMASUKAN');
            $table->string('msy_uuser', 20)->nullable()->comment('NO KP PEGAWAI KEMASKINI');

            $table->timestamps();
            $table->unique('msy_bilangan');
            $table->comment('MAKLUMAT MESYUARAT');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('osc_smk_mesyuarat');
    }
};
