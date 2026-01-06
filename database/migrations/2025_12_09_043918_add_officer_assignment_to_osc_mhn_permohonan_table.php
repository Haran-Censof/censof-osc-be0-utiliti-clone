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
            $table->string('mhn_idpegawai', 20)->nullable()->after('mhn_ptjpk')->comment('ID PEGAWAI YANG DIASSIGN');
            $table->index(['mhn_idpegawai']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('osc_mhn_permohonan', function (Blueprint $table) {
            $table->dropIndex(['mhn_idpegawai']);
            $table->dropColumn('mhn_idpegawai');
        });
    }
};
