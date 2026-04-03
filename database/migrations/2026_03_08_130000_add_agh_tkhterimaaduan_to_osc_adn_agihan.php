<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     * Purpose: Add agh_tkhterimaaduan column to track when officer accepts complaint.
     * 
     * Business Rule: This timestamp records when an officer accepts a complaint assignment,
     * allowing calculation of response time from submission (adn_tkhterima) to acceptance.
     * This is different from agh_udate which updates on every row change.
     */
    public function up(): void
    {
        Schema::table('osc_adn_agihan', function (Blueprint $table) {
            $table->dateTime('agh_tkhterimaaduan')
                ->nullable()
                ->after('agh_tkhulasan')
                ->comment('TARIKH PEGAWAI TERIMA ADUAN');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('osc_adn_agihan', function (Blueprint $table) {
            $table->dropColumn('agh_tkhterimaaduan');
        });
    }
};
