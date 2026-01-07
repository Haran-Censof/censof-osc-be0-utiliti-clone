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
        Schema::create('osc_mhn_iklan', function (Blueprint $table) {
            $table->id('id')->comment('Primary Key');
            $table->string('lan_idpbt', 10)->nullable()->comment('KOD SIRI PBT');
            $table->bigInteger('lan_nosiri')->nullable()->comment('NO SIRI PERMOHONAN');
            $table->integer('lan_akaun')->nullable()->comment('NO AKAUN LESEN - LEPAS LULUS');
            $table->string('lan_rujuk', 20)->nullable()->comment('RUJUKAN');
            $table->date('lan_mulai')->nullable()->comment('TARIKH MULA');
            $table->date('lan_tamti')->nullable()->comment('TARIKH TAMAT');
            $table->decimal('lan_amaun', 11, 2)->nullable()->comment('AMAUN');
            $table->string('lan_stajn', 1)->nullable()->comment('TANAH KOSONG');
            $table->string('lan_keadn', 1)->nullable()->comment('MELINTANG');
            $table->string('lan_stalp', 1)->nullable()->comment('BERLAMPU');
            $table->string('lan_aktif', 1)->nullable()->comment('AKTIF');
            $table->decimal('lan_panjg', 6, 2)->nullable()->comment('PANJANG');
            $table->decimal('lan_lebar', 6, 2)->nullable()->comment('LEBAR');
            $table->string('lan_tempt', 100)->nullable()->comment('TEMPAT');
            $table->string('lan_keter', 40)->nullable()->comment('KETERANGAN');
            $table->date('lan_batal')->nullable()->comment('BATAL');
            $table->string('lan_statf', 1)->nullable()->comment('STATUS');
            $table->string('lan_onama', 10)->nullable()->comment('NAMA');
            $table->date('lan_idate')->nullable()->comment('TARIKH INPUT');
            $table->date('lan_udate')->nullable()->comment('TARIKH KEMASKINI');
            $table->string('lan_iuser', 20)->nullable()->comment('NO KP PEGAWAI KEMASUKAN');
            $table->string('lan_uuser', 20)->nullable()->comment('NO KP PEGAWAI KEMASKINI');

            $table->timestamps();
            $table->unique(['lan_idpbt', 'lan_nosiri'], 'mhn_iklan_uk');
            $table->comment('MAKLUMAT IKLAN PEMOHON');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('osc_mhn_iklan');
    }
};
