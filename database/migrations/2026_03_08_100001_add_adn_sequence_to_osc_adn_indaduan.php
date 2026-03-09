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
        Schema::table('osc_adn_indaduan', function (Blueprint $table) {
            $table->unsignedInteger('adn_sequence')->nullable()->after('adn_noaduan')->comment('Sequence number for complaint reference');
            $table->index(['adn_sequence', 'adn_idate'], 'idx_sequence_year');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('osc_adn_indaduan', function (Blueprint $table) {
            $table->dropIndex('idx_sequence_year');
            $table->dropColumn('adn_sequence');
        });
    }
};
