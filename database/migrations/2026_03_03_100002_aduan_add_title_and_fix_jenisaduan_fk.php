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
     * Phase 1: Add title column and fix jenisaduan foreign key
     * 
     * Changes:
     * 1. Add adn_title column for complaint title
     * 2. Change adn_kodjenisaduan to use osc_kod_jenisaduan.id instead of kat_kodjenisaduan
     * 
     * Note: adn_kodjenis is NOT changed - it's for complaint type (A/P), not category
     */
    public function up(): void
    {
        // Add title column first
        Schema::table('osc_adn_indaduan', function (Blueprint $table) {
            $table->string('adn_tajuk', 255)
                ->nullable()
                ->after('adn_catatan')
                ->comment('Tajuk aduan');
        });

        // Check if foreign key exists before dropping
        $foreignKeyExists = DB::select("
            SELECT CONSTRAINT_NAME 
            FROM information_schema.TABLE_CONSTRAINTS 
            WHERE TABLE_SCHEMA = DATABASE() 
            AND TABLE_NAME = 'osc_adn_indaduan' 
            AND CONSTRAINT_NAME = 'osc_adn_indaduan_adn_kodjenisaduan_foreign'
        ");

        Schema::table('osc_adn_indaduan', function (Blueprint $table) use ($foreignKeyExists) {
            // Drop old foreign key constraint if exists
            if (!empty($foreignKeyExists)) {
                $table->dropForeign(['adn_kodjenisaduan']);
            }
            
            // Change adn_kodjenisaduan to bigInteger to match osc_kod_jenisaduan.id
            $table->bigInteger('adn_kodjenisaduan')->unsigned()->change();
            
            // Add new foreign key constraint to osc_kod_jenisaduan.id
            $table->foreign('adn_kodjenisaduan')
                ->references('id')
                ->on('osc_kod_jenisaduan')
                ->onDelete('restrict')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('osc_adn_indaduan', function (Blueprint $table) {
            // Drop the new foreign key
            $table->dropForeign(['adn_kodjenisaduan']);
            
            // Change adn_kodjenisaduan back to varchar(3)
            $table->string('adn_kodjenisaduan', 3)->change();
            
            // Restore old foreign key to kat_kodjenisaduan (if it existed)
            // Note: This may fail if the old FK never existed
            try {
                $table->foreign('adn_kodjenisaduan')
                    ->references('kat_kodjenisaduan')
                    ->on('osc_kod_jenisaduan')
                    ->onDelete('restrict')
                    ->onUpdate('cascade');
            } catch (\Exception $e) {
                // Ignore if FK creation fails
            }
            
            // Drop title column
            $table->dropColumn('adn_tajuk');
        });
    }
};
