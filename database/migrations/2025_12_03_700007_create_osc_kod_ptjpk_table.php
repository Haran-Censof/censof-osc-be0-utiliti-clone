<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('osc_kod_ptjpk', function (Blueprint $table) {
            $table->id();
            $table->string('ptj_idpbt', 10)->comment('ID PBT');
            $table->string('ptj_ptjpkcode', 6)->comment('KOD PTJPK');
            $table->string('ptj_ptjpkkelas', 1)->nullable()->comment('KELAS PTJPK [KELAS_PTJ]');
            $table->string('ptj_ptjpknama', 80)->nullable()->comment('KETERANGAN PTJPK');
            $table->string('ptj_namarngks', 20)->nullable()->comment('NAMA RINGKAS');
            $table->string('ptj_nopegawai', 15)->nullable()->comment('KETUA PTJPK');
            $table->date('ptj_idate')->nullable()->comment('TARIKH KEMASUKAN');
            $table->date('ptj_udate')->nullable()->comment('TARIKH KEMASKINI');
            $table->string('ptj_iuser', 20)->nullable()->comment('NO KP PEGAWAI KEMASUKAN');
            $table->string('ptj_uuser', 20)->nullable()->comment('NO KP PEGAWAI KEMASKINI');

            // Add Laravel timestamps
            $table->timestamps();

            // Add composite unique key
            $table->unique(['ptj_idpbt', 'ptj_ptjpkcode'], 'kod_ptjpk_uk');
            $table->comment('KOD PUSAT TANGGUNGJAWAB / PUSAT KOS');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('osc_kod_ptjpk');
    }
};
