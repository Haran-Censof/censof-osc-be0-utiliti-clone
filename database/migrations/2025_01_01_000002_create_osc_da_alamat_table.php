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
        Schema::create('osc_da_alamat', function (Blueprint $table) {
            $table->id('id')->comment('Primary Key');
            $table->string('almt_idpbt', 10)->nullable()->comment('KOD ID PBT');
            $table->string('almt_idpelanggan', 30)->nullable()->comment('NO KP / NO SSM / NO PASPORT');
            $table->integer('almt_alamatid')->nullable()->comment('ALAMAT ID');
            $table->string('almt_alamat01', 100)->nullable()->comment('ALAMAT 1');
            $table->string('almt_alamat02', 100)->nullable()->comment('ALAMAT 2');
            $table->string('almt_alamat03', 100)->nullable()->comment('ALAMAT 3');
            $table->string('almt_poskod', 5)->nullable()->comment('POSKOD');
            $table->string('almt_alamat04', 100)->nullable()->comment('ALAMAT 4');
            $table->string('almt_alamat05', 100)->nullable()->comment('ALAMAT 5');
            $table->string('almt_notelefon', 30)->nullable()->comment('NO TELEFON');
            $table->string('almt_nomborhp', 20)->nullable()->comment('NO TELEFON BIMBIT');
            $table->string('almt_nomborfax', 30)->nullable()->comment('NO FAKS');
            $table->string('almt_email', 50)->nullable()->comment('ALAMAT EMAIL');
            $table->string('almt_stoversea', 1)->nullable()->comment('ALAMAT LUAR NEGARA [Y]-YA  [T]-TIDAK');
            $table->date('almt_idate')->nullable()->comment('TARIKH KEMASUKAN');
            $table->date('almt_udate')->nullable()->comment('TARIKH KEMASKINI');
            $table->string('almt_iuser', 20)->nullable()->comment('NO KP PEGAWAI KEMASUKAN');
            $table->string('almt_uuser', 20)->nullable()->comment('NO KP PEGAWAI KEMASKINI');

            $table->timestamps();
            $table->comment('MAKLUMAT ALAMAT PELANGGAN');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('osc_da_alamat');
    }
};
