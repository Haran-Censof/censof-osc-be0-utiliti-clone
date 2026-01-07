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
        Schema::create('osc_da_pelanggan', function (Blueprint $table) {
            $table->id('id')->comment('Primary Key');
            $table->string('plgn_idpbt', 10)->nullable()->comment('KOD ID PBT');
            $table->string('plgn_idpelanggan', 30)->comment('NO KP / NO SSM / NO PASPORT');
            $table->string('plgn_pelanggannama', 100)->comment('NAMA PELANGGAN');
            $table->string('plgn_pelangganjenis', 1)->comment('[I]-INDIVIDU   [S]-SYARIKAT');
            $table->string('plgn_tinid', 15)->nullable()->comment('NO PENGENALAN CUKAI LHDN / TIN');
            $table->string('plgn_sstid', 20)->nullable()->comment('NO CUKAI DAN PERKHIDMATAN LHDN');
            $table->string('plgn_catat', 250)->nullable()->comment('CATATAN');
            $table->date('plgn_idate')->nullable()->comment('TARIKH KEMASUKAN');
            $table->date('plgn_udate')->nullable()->comment('TARIKH KEMASKINI');
            $table->string('plgn_iuser', 20)->nullable()->comment('NO KP PEGAWAI KEMASUKAN');
            $table->string('plgn_uuser', 20)->nullable()->comment('NO KP PEGAWAI KEMASKINI');

            $table->timestamps();
            $table->comment('MAKLUMAT PELANGGAN');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('osc_da_pelanggan');
    }
};
