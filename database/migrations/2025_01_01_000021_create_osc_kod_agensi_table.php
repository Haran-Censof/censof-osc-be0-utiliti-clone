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
        Schema::create('osc_kod_agensi', function (Blueprint $table) {
            $table->string('agn_kodspbt', 10)->comment('KOD PBT');
            $table->string('agn_kdagnsi', 2)->comment('KOD AGENSI');
            $table->string('agn_nmagnsi', 100)->nullable()->comment('NAMA AGENSI');
            $table->string('agn_namrgks', 40)->nullable()->comment('NAMA RINGKAS AGENSI');
            $table->string('agn_areazon', 5)->nullable()->comment('KOD ZON AGENSI - yg didaftarkan di lookup table');
            $table->string('agn_katgori', 3)->nullable()->comment('[ATK] - [BTD]');
            $table->string('agn_statusaktif', 1)->nullable();

            // Add Laravel timestamps
            $table->timestamps();

            // Add composite primary key
            $table->primary(['agn_kodspbt', 'agn_kdagnsi'], 'pk_osc_kodagensi');

            // Add indexes
            $table->index('agn_kodspbt');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('osc_kod_agensi');
    }
};
