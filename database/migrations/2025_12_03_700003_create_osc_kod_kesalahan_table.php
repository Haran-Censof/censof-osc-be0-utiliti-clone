<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('osc_kod_kesalahan', function (Blueprint $table) {
            $table->string('sal_akkod', 4)->nullable()->comment('KOD AKTA KESALAHAN');
            $table->string('sal_slkod', 10)->nullable()->comment('KOD KESALAHAN');
            $table->string('sal_sketr', 40)->nullable()->comment('SINGKATAN KETERANGAN');
            $table->string('sal_snama', 1000)->nullable()->comment('KETERANGAN');
            $table->string('sal_transaksi', 6)->nullable()->comment('KOD TRANSAKSI / KOD HASIL');
            $table->string('sal_ptjpk', 4)->nullable()->comment('KOD PTJPK');
            $table->decimal('sal_amaun', 11, 2)->nullable()->comment('AMAUN KESALAHAN');
            $table->string('sal_statt', 1)->nullable()->comment('STATUS AKTIF [Y]-Ya [T]-Tidak');
            $table->integer('sal_tnots')->nullable()->comment('TEMPOH DIKENAKAN NOTIS');
            $table->integer('sal_tmkmh')->nullable()->comment('TEMPOH DIKENAKAN TINDAKAN MAHKAMAH');
            $table->decimal('sal_amnts', 11, 2)->nullable()->comment('AMAUN NOTIS');
            $table->decimal('sal_ammkh', 11, 2)->nullable()->comment('AMAUN MAHKAMAH');
            $table->integer('sal_tmpoh1')->nullable()->comment('TEMPOH PERTAMA');
            $table->decimal('sal_amaun1', 11, 2)->nullable()->comment('KADAR KENAIKAN PERTAMA');
            $table->integer('sal_tmpoh2')->nullable()->comment('TEMPOH KEDUA');
            $table->decimal('sal_amaun2', 11, 2)->nullable()->comment('KADAR KENAIKAN KEDUA');
            $table->integer('sal_tmpoh3')->nullable()->comment('TEMPOH KETIGA');
            $table->decimal('sal_amaun3', 11, 2)->nullable()->comment('KADAR KENAIKAN KETIGA');
            $table->integer('sal_tnots1')->nullable()->comment('TEMPOH NOTIS PERTAMA');
            $table->decimal('sal_amnts1', 11, 2)->nullable()->comment('KADAR NOTIS PERTAMA');
            $table->integer('sal_tnots2')->nullable()->comment('TEMPOH NOTIS KEDUA');
            $table->decimal('sal_amnts2', 11, 2)->nullable()->comment('AMAUN NOTIS KEDUA');
            $table->datetime('sal_idate')->nullable()->comment('TARIK KEMASUKAN');
            $table->datetime('sal_udate')->nullable()->comment('TARIKH KEMASKINI');
            $table->string('sal_iuser', 20)->nullable()->comment('NO KP PEGAWAI KEMASUKAN');
            $table->string('sal_uuser', 20)->nullable()->comment('NO KP PEGAWAI KEMASKINI');
            
            $table->timestamps();
            $table->index(['sal_akkod', 'sal_slkod']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('osc_kod_kesalahan');
    }
};
