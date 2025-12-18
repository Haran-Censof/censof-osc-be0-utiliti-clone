<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('osc_smk_mesyuarat', function (Blueprint $table) {
            $table->string('msy_bilangan', 10)->nullable()->comment('BILANGAN MESYUARAT');
            $table->datetime('msy_tarikh')->nullable()->comment('TARIKH MESYUARAT');
            $table->string('msy_bulan', 2)->nullable()->comment('BULAN');
            $table->string('msy_kertaskerja', 20)->nullable()->comment('NO KERTAS KERJA');
            $table->string('msy_statf', 1)->nullable()->comment('STATUS MESYUARAT [B]-BELUM SELESAI [S]-SELESAI');
            $table->datetime('msy_idate')->nullable()->comment('TARIKH KEMASUKAN');
            $table->datetime('msy_udate')->nullable()->comment('TARIKH KEMASKINI');
            $table->string('msy_iuser', 20)->nullable()->comment('NO KP PEGAWAI KEMASUKAN');
            $table->string('msy_uuser', 20)->nullable()->comment('NO KP PEGAWAI KEMASKINI');
            
            $table->timestamps();
            $table->unique('msy_bilangan');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('osc_smk_mesyuarat');
    }
};
