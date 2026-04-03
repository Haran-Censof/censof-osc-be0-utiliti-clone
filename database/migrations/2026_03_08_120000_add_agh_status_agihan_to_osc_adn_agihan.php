<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     * Purpose: Add agh_status_agihan column to track active vs superseded agihan records.
     * 
     * Business Rule: When a complaint is reassigned, the old agihan record is marked 'S' (superseded)
     * and the new agihan record is marked 'A' (active). Only one active agihan per complaint.
     * 
     * This replaces the fragile MAX(agh_tkhulasan) approach which fails when two assignments
     * occur in the same second.
     */
    public function up(): void
    {
        Schema::table('osc_adn_agihan', function (Blueprint $table) {
            $table->char('agh_status_agihan', 1)
                ->default('A')
                ->after('agh_statadn')
                ->comment('STATUS AGIHAN [A]-AKTIF [S]-SUPERSEDED (diganti dengan agihan baru)');
        });

        // Set all existing records to 'A' (active) by default
        // In production, you may need to identify and mark superseded records based on business logic
        DB::table('osc_adn_agihan')->update(['agh_status_agihan' => 'A']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('osc_adn_agihan', function (Blueprint $table) {
            $table->dropColumn('agh_status_agihan');
        });
    }
};
