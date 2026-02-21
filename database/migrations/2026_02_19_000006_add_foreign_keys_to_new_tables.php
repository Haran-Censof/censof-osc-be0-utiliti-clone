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
     * Add foreign key constraints to newly created tables
     */
    public function up(): void
    {
        // Add foreign key to osc_ind_translesen
        if (Schema::hasTable('osc_ind_translesen') && Schema::hasTable('osc_kod_majlis')) {
            // Check if foreign key doesn't already exist
            $foreignKeys = DB::select("
                SELECT CONSTRAINT_NAME 
                FROM information_schema.TABLE_CONSTRAINTS 
                WHERE TABLE_SCHEMA = DATABASE() 
                AND TABLE_NAME = 'osc_ind_translesen' 
                AND CONSTRAINT_NAME = 'osc_ind_translesen_trn_idpbt_foreign'
            ");

            if (empty($foreignKeys)) {
                Schema::table('osc_ind_translesen', function (Blueprint $table) {
                    $table->foreign('trn_idpbt', 'osc_ind_translesen_trn_idpbt_foreign')
                        ->references('maj_idpbt')
                        ->on('osc_kod_majlis')
                        ->onDelete('restrict');
                });
            }
        }

        // Add foreign key to osc_ind_transbatal
        if (Schema::hasTable('osc_ind_transbatal') && Schema::hasTable('osc_kod_majlis')) {
            // Check if foreign key doesn't already exist
            $foreignKeys = DB::select("
                SELECT CONSTRAINT_NAME 
                FROM information_schema.TABLE_CONSTRAINTS 
                WHERE TABLE_SCHEMA = DATABASE() 
                AND TABLE_NAME = 'osc_ind_transbatal' 
                AND CONSTRAINT_NAME = 'osc_ind_transbatal_btl_idpbt_foreign'
            ");

            if (empty($foreignKeys)) {
                Schema::table('osc_ind_transbatal', function (Blueprint $table) {
                    $table->foreign('btl_idpbt', 'osc_ind_transbatal_btl_idpbt_foreign')
                        ->references('maj_idpbt')
                        ->on('osc_kod_majlis')
                        ->onDelete('restrict');
                });
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('osc_ind_translesen')) {
            Schema::table('osc_ind_translesen', function (Blueprint $table) {
                $table->dropForeign('osc_ind_translesen_trn_idpbt_foreign');
            });
        }

        if (Schema::hasTable('osc_ind_transbatal')) {
            Schema::table('osc_ind_transbatal', function (Blueprint $table) {
                $table->dropForeign('osc_ind_transbatal_btl_idpbt_foreign');
            });
        }
    }
};
