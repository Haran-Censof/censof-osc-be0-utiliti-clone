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
            // Add return-related columns after mhn_statl
            $table->date('mhn_tkhdipulang')->nullable()->after('mhn_statl')->comment('TARIKH DIPULANGKAN');
            $table->text('mhn_sebabdipulang')->nullable()->after('mhn_tkhdipulang')->comment('SEBAB DIPULANGKAN');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('osc_mhn_permohonan', function (Blueprint $table) {
            $table->dropColumn(['mhn_tkhdipulang', 'mhn_sebabdipulang']);
        });
    }
};
