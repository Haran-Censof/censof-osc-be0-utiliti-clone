<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations to create OSC_KOD_AKTVTAGENSI table (missing from MySQL).
     */
    public function up(): void
    {
        Schema::create('osc_kod_aktvtagensi', function (Blueprint $table) {
            $table->id(); // Auto-increment primary key
            $table->string('aka_idpbt', 10)->comment('KOD ID PBT');
            $table->string('aka_kodaktiviti', 5)->comment('KOD AKTIVITI');
            $table->string('aka_kodagensi', 10)->comment('KOD AGENSI');
            $table->string('aka_catatan', 200)->nullable()->comment('CATATAN');
            $table->char('aka_statf', 1)->nullable()->comment('STATUS AKTIF [Y]-YA [T]-TIDAK');
            $table->date('aka_idate')->nullable()->comment('TARIKH INPUT');
            $table->date('aka_udate')->nullable()->comment('TARIKH UPDATE');
            $table->string('aka_iuser', 20)->nullable()->comment('USER INPUT');
            $table->string('aka_uuser', 20)->nullable()->comment('USER UPDATE');

            // Laravel timestamps
            $table->timestamps();

            // Indexes
            $table->unique(['aka_idpbt', 'aka_kodaktiviti', 'aka_kodagensi'], 'kod_aktvtagensi_uk');
            $table->index(['aka_idpbt'], 'idx_aktvtagensi_pbt');
            $table->index(['aka_kodaktiviti'], 'idx_aktvtagensi_aktiviti');
            $table->index(['aka_kodagensi'], 'idx_aktvtagensi_agensi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('osc_kod_aktvtagensi');
    }
};
