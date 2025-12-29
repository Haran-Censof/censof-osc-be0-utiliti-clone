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
        Schema::table('osc_mhn_permohonan', function (Blueprint $table) {
            // Add return-related columns after mhn_sebabditolak
            $table->datetime('mhn_tarikhdipulang')->nullable()->after('mhn_sebabditolak')->comment('Return date');
            $table->text('mhn_sebabdipulang')->nullable()->after('mhn_tarikhdipulang')->comment('Return reason');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('osc_mhn_permohonan', function (Blueprint $table) {
            $table->dropColumn(['mhn_tarikhdipulang', 'mhn_sebabdipulang']);
        });
    }
};
