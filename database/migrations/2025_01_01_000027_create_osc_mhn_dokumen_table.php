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
        Schema::create('osc_mhn_dokumen', function (Blueprint $table) {
            $table->id('id')->comment('Primary Key');
            $table->string('doc_idpbt', 10)->nullable()->comment('KOD ID PBT');
            $table->string('doc_nosiri', 30)->nullable()->comment('NO SIRI PERMOHONAN');
            $table->integer('doc_akaun')->nullable()->comment('NO AKAUN : SELEPAS KELULUSAN');
            $table->integer('doc_dcsiri')->nullable()->comment('NO SIRI DOKUMEN');
            $table->longText('doc_dokumen')->nullable()->comment('IMAGE DOKUMEN');
            $table->string('doc_catatan', 250)->nullable()->comment('CATATAN KEPADA DOKUMEN');
            $table->date('doc_idate')->nullable()->comment('TARIKH INPUT');
            $table->date('doc_udate')->nullable()->comment('TARIKH KEMASKINI');
            $table->string('doc_iuser', 20)->nullable()->comment('NO KP PEGAWAI KEMASUKAN');
            $table->string('doc_uuser', 20)->nullable()->comment('NO KP PEGAWAI KEMASKINI');

            $table->timestamps();
            $table->unique(['doc_idpbt', 'doc_nosiri', 'doc_dcsiri'], 'mhn_dokumen_uk');
            $table->comment('MAKLUMAT DOKUMEN PEMOHON');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('osc_mhn_dokumen');
    }
};
