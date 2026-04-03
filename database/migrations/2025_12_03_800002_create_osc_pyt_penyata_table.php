<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('osc_pyt_penyata', function (Blueprint $table) {
            $table->id('id')->comment('Primary Key');
            $table->string('pyta_idpbt', 10)->nullable()->comment('KOD ID PBT');
            $table->integer('pyta_akaun')->comment('NO AKAUN');
            $table->string('pyta_transaksi', 6)->nullable()->comment('KOD TRAKSAKSI/KOD HASIL');
            $table->string('pyta_noresit', 20)->nullable()->comment('NO RESIT');
            $table->date('pyta_tkhresit')->nullable()->comment('TARIKH RESIT');
            $table->decimal('pyta_amnresit', 11, 2)->nullable()->comment('AMAUN RESIT');
            $table->string('pyta_statf', 1)->nullable()->comment('STATUS FAIL');
            $table->string('pyta_rujukan', 7)->nullable()->comment('NO RUJUKAN KEWANGAN');
            $table->date('pyta_idate')->nullable()->comment('TARIKH INPUT');
            $table->date('pyta_udate')->nullable()->comment('TARIKH KEMASKINI');
            $table->string('pyta_iuser', 20)->nullable()->comment('NO KP PEGAWAI KEMASUKAN');
            $table->string('pyta_uuser', 20)->nullable()->comment('NO KP PEGAWAI KEMASKINI');

            $table->timestamps();
            $table->comment('PENYATA AKAUN INDIVIDU');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('osc_pyt_penyata');
    }
};
