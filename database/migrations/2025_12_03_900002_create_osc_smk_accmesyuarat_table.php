<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('osc_smk_accmesyuarat', function (Blueprint $table) {
            $table->id('id')->comment('Primary Key');
            $table->string('ame_idpbt', 10)->comment('KOD SIRI ID PBT');
            $table->bigInteger('ame_nosiri')->comment('NO SIRI PERMOHONAN');
            $table->date('ame_tkhmesyuarat')->comment('TARIKH MESYUARAT OSC');
            $table->string('ame_ulsiri', 2)->nullable()->comment('NO SIRI ULASAN [ULASAN]');
            $table->string('ame_catatan', 250)->nullable()->comment('CATATAN');
            $table->string('ame_statf', 1)->nullable()->comment('STATUS [P]- PERMOHONAN [G]-GANTUNG [S]-SELESAI');
            $table->date('ame_idate')->nullable()->comment('TARIKH KEMASUKAN');
            $table->date('ame_udate')->nullable()->comment('TARIKH KEMASKINI');
            $table->string('ame_iuser', 20)->nullable()->comment('PEGAWAI KEMASUKAN MAKLUMAT');
            $table->string('ame_uuser', 20)->nullable()->comment('PEGAWAI KEMASKINI MAKLUMAT');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('osc_smk_accmesyuarat');
    }
};
