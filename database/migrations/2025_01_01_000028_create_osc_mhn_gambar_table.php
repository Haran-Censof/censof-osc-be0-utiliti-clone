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
        Schema::create('osc_mhn_gambar', function (Blueprint $table) {
            $table->string('gbr_kdsrpbt', 10)->comment('KOD SIRI PBT');
            $table->decimal('gbr_nosiri', 9, 0)->comment('NO SIRI PERMOHONAN');
            $table->decimal('gbr_akaun', 7, 0)->nullable()->comment('NO AKAUN : LEPAS KELULUSAN');
            $table->decimal('gbr_imsiri', 3, 0)->comment('NO SIRI IMAGE');
            $table->binary('gbr_image')->nullable()->comment('GAMBAR');
            $table->string('gbr_nfile', 25)->nullable()->comment('NAMA FAIL');
            $table->dateTime('gbr_idate')->nullable()->comment('TARIKH INPUT');
            $table->dateTime('gbr_udate')->nullable()->comment('TARIKH KEMASKINI');

            // Add Laravel timestamps
            $table->timestamps();

            // Add composite primary key
            $table->primary(['gbr_kdsrpbt', 'gbr_nosiri', 'gbr_imsiri'], 'pk_osc_mhn_gambar');

            // Add indexes
            $table->index(['gbr_kdsrpbt', 'gbr_nosiri']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('osc_mhn_gambar');
    }
};
