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
        Schema::table('osc_kod_jenis', function (Blueprint $table) {
            $table->char('jns_statf', 1)->default('Y')->comment('STATUS [Y] - Ya [T] - Tidak');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('osc_kod_jenis', function (Blueprint $table) {
            $table->dropColumn('jns_statf');
        });
    }
};
