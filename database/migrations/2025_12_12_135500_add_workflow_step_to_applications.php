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
            $table->string('mhn_langkahwf', 50)->nullable()->after('mhn_statl')
                ->comment('LANGKAH WORKFLOW SEMASA');

            $table->index('mhn_langkahwf');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('osc_mhn_permohonan', function (Blueprint $table) {
            $table->dropIndex(['mhn_langkahwf']);
            $table->dropColumn('mhn_langkahwf');
        });
    }
};
