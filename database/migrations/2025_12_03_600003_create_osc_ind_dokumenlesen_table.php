<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('osc_ind_dokumenlesen', function (Blueprint $table) {
            $table->id('id')->comment('Primary Key');
            $table->string('doc_idpbt', 10)->nullable()->comment('KOD ID PBT');
            $table->integer('doc_akaun')->nullable()->comment('NO AKAUN');
            $table->integer('doc_dcsiri')->nullable()->comment('NO SIRI DOKUMEN');
            $table->longText('doc_dokumen')->nullable()->comment('IMAGE DOKUMEN');
            $table->string('doc_catatan', 250)->nullable()->comment('CATATAN KEPADA DOKUMEN');
            $table->date('doc_idate')->nullable()->comment('TARIKH INPUT');
            $table->date('doc_udate')->nullable()->comment('TARIKH KEMASKINI');
            $table->string('doc_iuser', 20)->nullable()->comment('NO KP PEGAWAI KEMASUKAN');
            $table->string('doc_uuser', 20)->nullable()->comment('NO KP PEGAWAI KEMASKINI');
            
            $table->timestamps();
            $table->index(['doc_idpbt', 'doc_akaun']);
            $table->comment('MAKLUMAT  DOKUMEN INDUK PELESEN ');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('osc_ind_dokumenlesen');
    }
};
