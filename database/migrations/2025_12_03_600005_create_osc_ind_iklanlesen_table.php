<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('osc_ind_iklanlesen', function (Blueprint $table) {
            $table->id('id')->comment('Primary Key');
            $table->string('lan_idpbt', 10)->nullable()->comment('KOD SIRI PBT');
            $table->integer('lan_akaun')->nullable()->comment('NO AKAUN PELESEN');
            $table->string('lan_rujukan', 20)->nullable()->comment('NO RUJUKAN IKLAN');
            $table->date('lan_tkhmula')->nullable()->comment('TARIKH MULA');
            $table->date('lan_tkhtmt')->nullable()->comment('TARIKH TAMAT');
            $table->decimal('lan_amaun', 11, 2)->nullable()->comment('AMAUN');
            $table->string('lan_lentang', 1)->nullable()->comment('MELINTANG');
            $table->string('lan_berlampu', 1)->nullable()->comment('BERLAMPU');
            $table->string('lan_stataktif', 1)->nullable()->comment('AKTIF');
            $table->decimal('lan_panjang', 6, 2)->nullable()->comment('PANJANG');
            $table->decimal('lan_lebar', 6, 2)->nullable()->comment('LEBAR');
            $table->string('lan_tempat', 100)->nullable()->comment('TEMPAT');
            $table->string('lan_keterangan', 40)->nullable()->comment('KETERANGAN');
            $table->date('lan_tkhbatal')->nullable()->comment('TARIKH BATAL');
            $table->string('lan_statf', 1)->nullable()->comment('STATUS IKLAN');
            $table->date('lan_idate')->nullable()->comment('TARIKH INPUT');
            $table->date('lan_udate')->nullable()->comment('TARIKH KEMASKINI');
            $table->string('lan_iuser', 20)->nullable()->comment('NO KP PEGAWAI KEMASUKAN');
            $table->string('lan_uuser', 20)->nullable()->comment('NO KP PEGAWAI KEMASKINI');

            $table->timestamps();
            $table->index(['lan_idpbt', 'lan_akaun']);
            $table->comment('MAKLUMAT IKLAN PELESEN');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('osc_ind_iklanlesen');
    }
};
