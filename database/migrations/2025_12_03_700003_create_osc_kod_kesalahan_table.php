<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('osc_kod_kesalahan', function (Blueprint $table) {
            $table->id();
            $table->string('sal_idpbt', 10)->comment('ID PBT');
            $table->string('sal_aktakod', 4)->comment('KOD AKTA KESALAHAN');
            $table->string('sal_salahkod', 10)->comment('KOD KESALAHAN');
            $table->string('sal_keterrgks', 40)->nullable()->comment('SINGKATAN KETERANGAN');
            $table->string('sal_keterangan', 1000)->nullable()->comment('KETERANGAN');
            $table->string('sal_transaksi', 6)->nullable()->comment('KOD TRANSAKSI / KOD HASIL');
            $table->string('sal_ptjpk', 6)->nullable()->comment('KOD PTJPK');
            $table->decimal('sal_amaun', 11, 2)->nullable()->comment('AMAUN KESALAHAN');
            $table->string('sal_statt', 1)->nullable()->comment('STATUS AKTIF [Y]-Ya [T]-Tidak');
            $table->smallInteger('sal_tempohnotis')->nullable()->comment('TEMPOH DIKENAKAN NOTIS');
            $table->smallInteger('sal_tempohmkmh')->nullable()->comment('TEMPOH DIKENAKAN TINDAKAN MAHKAMAH');
            $table->decimal('sal_amaunnotis', 11, 2)->nullable()->comment('AMAUN NOTIS');
            $table->decimal('sal_amaunmkmh', 11, 2)->nullable()->comment('AMAUN MAHKAMAH');
            $table->smallInteger('sal_tempoh1')->nullable()->comment('TEMPOH PERTAMA');
            $table->decimal('sal_amaun1', 11, 2)->nullable()->comment('KADAR KENAIKAN PERTAMA');
            $table->smallInteger('sal_tempoh2')->nullable()->comment('TEMPOH KEDUA');
            $table->decimal('sal_amaun2', 11, 2)->nullable()->comment('KADAR KENAIKAN KEDUA');
            $table->smallInteger('sal_tempoh3')->nullable()->comment('TEMPOH KETIGA');
            $table->decimal('sal_amaun3', 11, 2)->nullable()->comment('KADAR KENAIKAN KETIGA');
            $table->smallInteger('sal_tempohnotis1')->nullable()->comment('TEMPOH NOTIS PERTAMA');
            $table->decimal('sal_amaunnotis1', 11, 2)->nullable()->comment('KADAR NOTIS PERTAMA');
            $table->smallInteger('sal_tempohnotis2')->nullable()->comment('TEMPOH NOTIS KEDUA');
            $table->decimal('sal_amaunnotis2', 11, 2)->nullable()->comment('AMAUN NOTIS KEDUA');
            $table->date('sal_idate')->nullable()->comment('TARIK KEMASUKAN');
            $table->date('sal_udate')->nullable()->comment('TARIKH KEMASKINI');
            $table->string('sal_iuser', 20)->nullable()->comment('NO KP PEGAWAI KEMASUKAN');
            $table->string('sal_uuser', 20)->nullable()->comment('NO KP PEGAWAI KEMASKINI');

            // Add Laravel timestamps
            $table->timestamps();

            // Add composite unique key
            $table->unique(['sal_idpbt', 'sal_aktakod', 'sal_salahkod'], 'kod_kesalahan_uk');
            $table->comment('MAKLUMAT KOD KESALAHAN.');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('osc_kod_kesalahan');
    }
};
