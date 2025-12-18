<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('osc_ind_gambarlesen', function (Blueprint $table) {
            $table->string('gbr_idpbt', 10)->nullable()->comment('KOD ID PBT');
            $table->integer('gbr_akaun')->nullable()->comment('NO AKAUN : LEPAS KELULUSAN');
            $table->integer('gbr_imsiri')->nullable()->comment('NO SIRI IMAGE');
            $table->string('gbr_namafail', 100)->nullable()->comment('NAMA FAIL IMAGE');
            $table->string('gbr_pathfile', 100)->nullable()->comment('LOKASI FAIL');
            $table->datetime('gbr_idate')->nullable()->comment('TARIKH INPUT');
            $table->datetime('gbr_udate')->nullable()->comment('TARIKH KEMASKINI');
            $table->string('gbr_iuser', 20)->nullable()->comment('NO KP PEGAWAI KEMASUKAN');
            $table->string('gbr_uuser', 20)->nullable()->comment('NO KP PEGAWAI KEMASKINI');
            
            $table->timestamps();
            $table->index(['gbr_idpbt', 'gbr_akaun']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('osc_ind_gambarlesen');
    }
};
