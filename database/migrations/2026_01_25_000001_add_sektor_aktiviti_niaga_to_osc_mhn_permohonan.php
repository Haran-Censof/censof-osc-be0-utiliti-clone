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
            $table->string('mhn_kodsektor', 5)->nullable()->after('mhn_kodlokasi')->comment('KOD SEKTOR PERNIAGAAN');
            $table->string('mhn_kodaktiviti', 5)->nullable()->after('mhn_kodsektor')->comment('KOD AKTIVITI PERNIAGAAN');
            $table->unsignedBigInteger('mhn_idniaga')->nullable()->after('mhn_kodaktiviti')->comment('ID KOD NIAGA');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('osc_mhn_permohonan', function (Blueprint $table) {
            $table->dropColumn(['mhn_kodsektor', 'mhn_kodaktiviti', 'mhn_idniaga']);
        });
    }
};
