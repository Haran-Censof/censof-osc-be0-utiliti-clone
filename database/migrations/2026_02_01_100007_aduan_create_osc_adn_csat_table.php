<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * SRS UC-PL-AD-PA-06: "Kumpul skor kepuasan selepas penutupan tiket."
     * No existing table can hold this data.
     */
    public function up(): void
    {
        Schema::create('osc_adn_csat', function (Blueprint $table) {
            $table->id()->comment('Primary Key');
            
            $table->string('csat_idpbt', 10)
                ->comment('ID PBT');
            
            $table->string('csat_noaduan', 16)
                ->comment('NO ADUAN');
            
            $table->tinyInteger('csat_skor')
                ->nullable()
                ->comment('Skor kepuasan (1-5)');
            
            $table->text('csat_komen')
                ->nullable()
                ->comment('Komen pelanggan');
            
            $table->date('csat_tkhskor')
                ->nullable()
                ->comment('Tarikh skor diberi');
            
            $table->date('csat_idate')
                ->nullable()
                ->comment('Tarikh kemasukan');
            
            $table->string('csat_iuser', 20)
                ->nullable()
                ->comment('NO KP pengguna');
            
            $table->timestamps();
            
            // Unique constraint: one CSAT per complaint
            $table->unique(['csat_idpbt', 'csat_noaduan'], 'csat_uk');
            
            // Foreign key to osc_kod_majlis
            $table->foreign('csat_idpbt')
                ->references('maj_idpbt')
                ->on('osc_kod_majlis')
                ->onDelete('restrict');
            
            $table->comment('SKOR KEPUASAN PELANGGAN (CSAT) - SRS UC-PL-AD-PA-06');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('osc_adn_csat');
    }
};
