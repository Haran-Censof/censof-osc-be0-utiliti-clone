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
        Schema::create('osc_da_individu', function (Blueprint $table) {
            $table->id('id')->comment('Primary Key');
            $table->string('indv_idpbt', 10)->nullable()->comment('ID PBT');
            $table->string('indv_idpelanggan', 20)->comment('NO KAD PENGENALAN');
            $table->string('indv_jenisid', 1)->nullable()->comment('JENIS PENGENALAN [A]-AWAM  [T]-TENTERA  [P]-POLIS');
            $table->string('indv_lhdntinid', 14)->nullable()->comment('NO PENGENALAN CUKAI LHDN / TIN');
            $table->string('indv_passpot', 10)->nullable()->comment('NO PASPORT');
            $table->string('indv_gelar', 1)->nullable()->comment('GELARAN - REFER OSC_CONTROLTABLE');
            $table->string('indv_jantina', 1)->nullable()->comment('JANTINA - REFER OSC_CONTROLTABLE');
            $table->string('indv_bangsa', 1)->nullable()->comment('BANGSA - REFER OSC_CONTROLTABLE');
            $table->string('indv_warganegara', 1)->nullable()->comment('WARGANEGARA [Y]-YA   [T]-TIDAK');
            $table->date('indv_tarikhlahir')->nullable()->comment('TARIKH LAHIR');
            $table->string('indv_stperkahwinan', 1)->nullable()->comment('STATUS PERKAHWINAN - REFER OSC_CONTROLTABLE');
            $table->decimal('indv_pendapatan', 12, 2)->nullable()->comment('PENDAPATAN - REFER OSC_CONTROLTABLE');
            $table->string('indv_agama', 1)->nullable()->comment('AGAMA - REFER OSC_CONTROLTABLE');
            $table->string('indv_okustatus', 1)->nullable()->comment('STATUS OKU [Y]-YA  [T]-TIDAK');
            $table->string('indv_idoku', 20)->nullable()->comment('ID OKU');
            $table->date('indv_idate')->nullable()->comment('TARIKH KEMASUKAN');
            $table->date('indv_udate')->nullable()->comment('TARIKH KEMASKINI');
            $table->string('indv_iuser', 20)->nullable()->comment('NO KP PEGAWAI KEMASUKAN');
            $table->string('indv_uuser', 20)->nullable()->comment('NO KP PEGAWAI KEMASKINI');

            // JPN Verification fields
            $table->boolean('indv_jpnverified')->default(false)->comment('JPN VERIFICATION STATUS');
            $table->dateTime('indv_jpnverifiedat')->nullable()->comment('JPN VERIFICATION TIMESTAMP');
            $table->string('indv_jpnverifyid', 50)->nullable()->comment('JPN VERIFICATION REFERENCE ID');
            $table->string('indv_profilephoto', 255)->nullable()->comment('PROFILE PHOTO PATH');

            $table->timestamps();
            $table->comment('MAKLUMAT PELANGGAN NDIVIDU');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('osc_da_individu');
    }
};
