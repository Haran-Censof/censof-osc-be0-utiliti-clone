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
        // Add missing status column to osc_kod_undang table
        Schema::table('osc_kod_undang', function (Blueprint $table) {
            $table->char('und_statf', 1)->default('Y')->comment('STATUS [Y] - Aktif [T] - Tidak Aktif')->after('und_ketrng3');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop status column from osc_kod_undang table
        Schema::table('osc_kod_undang', function (Blueprint $table) {
            $table->dropColumn('und_statf');
        });
    }
};
