<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('osc_ind_lpekerja', function (Blueprint $table) {
            $table->id('id')->comment('Primary Key');
            $table->string('lpk_idpbt', 10)->nullable()->comment('KOD ID PBT');
            $table->bigInteger('lpk_akaun')->nullable()->comment('NO AKAUN PELESEN');
            $table->integer('lpk_melayu')->nullable()->comment('BILANGAN MELAYU');
            $table->integer('lpk_cina')->nullable()->comment('BILANGAN CINA');
            $table->integer('lpk_india')->nullable()->comment('BILANGAN INDIA');
            $table->integer('lpk_lainlain')->nullable()->comment('BILANGAN LAIN-LAIN');
            $table->date('lpk_idate')->nullable()->comment('TARIKH KEMASUKAN');
            $table->date('lpk_udate')->nullable()->comment('TARIKH KEMASKINI');
            $table->string('lpk_iuser', 20)->nullable()->comment('PEGAWAI KEMASUKAN');
            $table->string('lpk_uuser', 20)->nullable()->comment('PEGAWAI KEMASKINI');

            $table->timestamps();
            $table->index(['lpk_idpbt', 'lpk_akaun']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('osc_ind_lpekerja');
    }
};
