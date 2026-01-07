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
            $table->id();
            $table->string('agn_idpbt', 10)->comment('KOD PBT');
            $table->string('agn_kodagensi', 10)->comment('KOD AGENSI');
            $table->string('agn_namaagensi', 100)->nullable()->comment('NAMA AGENSI');
            $table->string('agn_namargks', 40)->nullable()->comment('NAMA RINGKAS AGENSI');
            $table->string('agn_areazon', 5)->nullable()->comment('KOD ZON AGENSI - yg didaftarkan di lookup table');
            $table->string('agn_katgori', 3)->nullable()->comment('[ATK] - [BTD]');
            $table->char('agn_statf', 1)->nullable();
            $table->date('agn_idate')->nullable();
            $table->date('agn_udate')->nullable();
            $table->string('agn_iuser', 20)->nullable();
            $table->string('agn_uuser', 20)->nullable();

            // Add Laravel timestamps
            $table->timestamps();

            // Add composite unique key
            $table->unique(['agn_idpbt', 'agn_kodagensi'], 'kod_agensi_uk');
            $table->comment('KOD AGENSI TEKNIKAL DALAM DAN LUAR');
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
