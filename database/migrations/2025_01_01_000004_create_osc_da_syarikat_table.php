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
        Schema::create('osc_da_syarikat', function (Blueprint $table) {
            $table->id('id')->comment('Primary Key');
            $table->string('sykt_idpbt', 10)->nullable()->comment('KOD ID PBT');
            $table->string('sykt_idpelanggan', 30)->comment('NO SSM');
            $table->string('sykt_lhdnsstid', 20)->nullable()->comment('ID SST LHDN');
            $table->string('sykt_nodaftarkew', 20)->nullable()->comment('NO DAFTAR KEMENTERIAN KEWANGAN');
            $table->string('sykt_nodaftarcidb', 20)->nullable()->comment('NO DAFTAR CIDB');
            $table->string('sykt_nodaftarpkk', 20)->nullable()->comment('NO DAFTAR PERTUBUHAN KONTRAKTOR');
            $table->string('sykt_statusbumi', 1)->nullable()->comment('STATUS BUMIPUTRA [Y]-YA   [T]-TIDAK');
            $table->date('sykt_tkhmulaniaga')->nullable()->comment('TARIKH MULA NIAGA');
            $table->date('sykt_tkhtmtniaga')->nullable()->comment('TARIKH TAMAT NIAGA');
            $table->string('sykt_idplgcontact', 15)->nullable()->comment('NO TELEFON PEGAWAI DIHUBUNGI');
            $table->string('sykt_contactnama', 100)->nullable()->comment('NAMA PEGAWAI DIHUBUNGI');
            $table->date('sykt_idate')->nullable()->comment('TARIKH KEMASUKAN');
            $table->date('sykt_udate')->nullable()->comment('TARIKH KEMASKINI');
            $table->string('sykt_iuser', 20)->nullable()->comment('NO KP PEGAWAI KEMASUKAN');
            $table->string('sykt_uuser', 20)->nullable()->comment('NO KP PEGAWAI KEMASKINI');

            $table->timestamps();
            $table->comment('MAKLUMAT SYARIKAT');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('osc_da_syarikat');
    }
};
