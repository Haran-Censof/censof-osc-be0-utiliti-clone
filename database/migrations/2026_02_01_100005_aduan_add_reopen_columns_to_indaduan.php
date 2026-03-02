<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * - adn_tkhselesai: Explicit closure date
     * - adn_reopen_count: Track number of reopens
     * - adn_tkhreopen: Track when reopen occurred
     */
    public function up(): void
    {
        Schema::table('osc_adn_indaduan', function (Blueprint $table) {
            $table->date('adn_tkhselesai')
                ->nullable()
                ->after('adn_sla_due_date')
                ->comment('Tarikh selesai - SRS UC-PL-AD-PA-03-03');
            
            $table->tinyInteger('adn_reopen_count')
                ->default(0)
                ->after('adn_tkhselesai')
                ->comment('Bilangan kali dibuka semula - SRS UC-PL-AD-PA-03-05');
            
            $table->date('adn_tkhreopen')
                ->nullable()
                ->after('adn_reopen_count')
                ->comment('Tarikh buka semula terakhir');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('osc_adn_indaduan', function (Blueprint $table) {
            $table->dropColumn([
                'adn_tkhselesai',
                'adn_reopen_count',
                'adn_tkhreopen'
            ]);
        });
    }
};
