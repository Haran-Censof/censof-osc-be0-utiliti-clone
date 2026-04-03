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
            $table->string('mhn_statbatal', 1)->nullable()->default('T')->after('mhn_statl')->comment('STATUS BATAL PERMOHONAN [Y]-YA [T]-TIDAK');
            $table->text('mhn_alasanbatal')->nullable()->after('mhn_statbatal')->comment('ALASAN BATAL PERMOHONAN');
            $table->date('mhn_tkhbatal')->nullable()->after('mhn_alasanbatal')->comment('TARIKH BATAL PERMOHONAN');
            $table->string('mhn_statnotif', 1)->nullable()->default('T')->after('mhn_tkhbatal')->comment('STATUS NOTIFIKASI BATAL [Y]-YA [T]-TIDAK');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('osc_mhn_permohonan', function (Blueprint $table) {
            $table->dropColumn([
                'mhn_statbatal',
                'mhn_alasanbatal',
                'mhn_tkhbatal',
                'mhn_statnotif',
            ]);
        });
    }
};
