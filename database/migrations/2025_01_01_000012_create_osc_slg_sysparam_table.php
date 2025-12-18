<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('osc_slg_sysparam', function (Blueprint $table) {
            $table->string('para_idpbt', 10)->nullable()->comment('KOD ID PBT');
            $table->integer('para_id')->nullable()->comment('PARAMETER ID');
            $table->string('para_desc', 30)->nullable()->comment('KETERANGAN');
            $table->string('para_value', 500)->nullable()->comment('CATATAN');
            $table->string('para_iuser', 20)->nullable()->comment('NO KP PEGAWAI KEMASUKAN');
            $table->string('para_uuser', 20)->nullable()->comment('NO KP PEGAWAI KEMASKINI');

            $table->timestamps();
            $table->index('para_idpbt');
            $table->index('para_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('osc_slg_sysparam');
    }
};
