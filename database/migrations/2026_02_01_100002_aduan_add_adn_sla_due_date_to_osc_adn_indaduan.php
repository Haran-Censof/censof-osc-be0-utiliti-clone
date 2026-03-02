<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Reason: SRS UC-PL-AD-PA-01-03 explicitly requires SLA to be set per ticket.
     * This is computed on ticket creation from kat_piagam (days) in osc_kod_jenisaduan.
     * Must exist at INSERT time — cannot defer.
     */
    public function up(): void
    {
        Schema::table('osc_adn_indaduan', function (Blueprint $table) {
            $table->date('adn_sla_due_date')
                ->nullable()
                ->after('adn_stataduan')
                ->comment('SLA due date — computed as adn_tkhterima + kat_piagam days');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('osc_adn_indaduan', function (Blueprint $table) {
            $table->dropColumn('adn_sla_due_date');
        });
    }
};
