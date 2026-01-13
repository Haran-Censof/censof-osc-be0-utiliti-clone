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
        Schema::table('osc_da_alamat', function (Blueprint $table) {
            if (!Schema::hasColumn('osc_da_alamat', 'almt_jenis')) {
                $table->string('almt_jenis', 10)->nullable()->comment('JENIS ALAMAT [HOME, MAILING, BUSINESS]');
            }
            if (!Schema::hasColumn('osc_da_alamat', 'almt_default')) {
                $table->boolean('almt_default')->default(false)->comment('DEFAULT ADDRESS');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('osc_da_alamat', function (Blueprint $table) {
            $table->dropColumn(['almt_jenis', 'almt_default']);
        });
    }
};
