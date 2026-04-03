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
            $table->unsignedBigInteger('mhn_idversilesen')->nullable()->after('mhn_ptjpk')->comment('ID VERSI JENIS LESEN');

            $table->foreign('mhn_idversilesen')
                ->references('id')
                ->on('license_type_versions')
                ->onDelete('set null');

            $table->index('mhn_idversilesen');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('osc_mhn_permohonan', function (Blueprint $table) {
            $table->dropForeign(['mhn_idversilesen']);
            $table->dropIndex(['mhn_idversilesen']);
            $table->dropColumn('mhn_idversilesen');
        });
    }
};
