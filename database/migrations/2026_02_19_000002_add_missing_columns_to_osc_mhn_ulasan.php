<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     * Add missing columns to osc_mhn_ulasan to match Oracle structure
     */
    public function up(): void
    {
        if (Schema::hasTable('osc_mhn_ulasan')) {
            Schema::table('osc_mhn_ulasan', function (Blueprint $table) {
                // Add missing columns after uls_pegawai
                if (!Schema::hasColumn('osc_mhn_ulasan', 'uls_peglulus')) {
                    $table->string('uls_peglulus', 100)->nullable()
                        ->after('uls_pegawai')
                        ->comment('PEGAWAI YANG MELULUSKAN');
                }

                if (!Schema::hasColumn('osc_mhn_ulasan', 'uls_tkhlulus')) {
                    $table->date('uls_tkhlulus')->nullable()
                        ->after('uls_tkhulas')
                        ->comment('TARIKH KELULUSAN');
                }

                if (!Schema::hasColumn('osc_mhn_ulasan', 'uls_catatan')) {
                    $table->string('uls_catatan', 500)->nullable()
                        ->after('uls_tkhlulus')
                        ->comment('CATATAN');
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('osc_mhn_ulasan')) {
            Schema::table('osc_mhn_ulasan', function (Blueprint $table) {
                $table->dropColumn(['uls_peglulus', 'uls_tkhlulus', 'uls_catatan']);
            });
        }
    }
};
