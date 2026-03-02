<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     * Changes foreign key relationship from code-based to ID-based:
     * OLD: osc_adn_indaduan.adn_kodjenisaduan (varchar) -> osc_kod_jenisaduan.kat_kodjenisaduan (varchar)
     * NEW: osc_adn_indaduan.adn_jenisaduan_id (bigint) -> osc_kod_jenisaduan.id (bigint)
     * 
     * Note: Table will be truncated before running this migration
     */
    public function up(): void
    {
        Schema::table('osc_adn_indaduan', function (Blueprint $table) {
            // Add new ID-based foreign key column
            $table->unsignedBigInteger('adn_jenisaduan_id')->nullable()->after('adn_kodjenisaduan')->comment('FK to osc_kod_jenisaduan.id');
            
            // Add foreign key constraint
            $table->foreign('adn_jenisaduan_id', 'fk_adn_jenisaduan')
                ->references('id')
                ->on('osc_kod_jenisaduan')
                ->onDelete('restrict')
                ->onUpdate('cascade');
            
            $table->index('adn_jenisaduan_id');
        });

        // Note: adn_kodjenisaduan column is kept for backward compatibility
        // It can be dropped in a future migration after confirming all code uses the new column
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('osc_adn_indaduan', function (Blueprint $table) {
            // Drop foreign key and index
            $table->dropForeign('fk_adn_jenisaduan');
            $table->dropIndex(['adn_jenisaduan_id']);
            
            // Drop the new column
            $table->dropColumn('adn_jenisaduan_id');
        });
    }
};
