<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     * Add missing receipt fields to osc_mhn_transaksi to match Oracle structure
     */
    public function up(): void
    {
        if (Schema::hasTable('osc_mhn_transaksi')) {
            Schema::table('osc_mhn_transaksi', function (Blueprint $table) {
                // Add missing receipt fields after trn_ckaun
                if (!Schema::hasColumn('osc_mhn_transaksi', 'trn_tkres')) {
                    $table->date('trn_tkres')->nullable()
                        ->after('trn_ckaun')
                        ->comment('TARIKH RESIT CAGARAN');
                }

                if (!Schema::hasColumn('osc_mhn_transaksi', 'trn_nores')) {
                    $table->string('trn_nores', 20)->nullable()
                        ->after('trn_tkres')
                        ->comment('NO RESIT CAGARAN');
                }

                if (!Schema::hasColumn('osc_mhn_transaksi', 'trn_amres')) {
                    $table->decimal('trn_amres', 11, 2)->nullable()
                        ->after('trn_nores')
                        ->comment('AMAUN RESIT CAGARAN');
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('osc_mhn_transaksi')) {
            Schema::table('osc_mhn_transaksi', function (Blueprint $table) {
                $table->dropColumn(['trn_tkres', 'trn_nores', 'trn_amres']);
            });
        }
    }
};
