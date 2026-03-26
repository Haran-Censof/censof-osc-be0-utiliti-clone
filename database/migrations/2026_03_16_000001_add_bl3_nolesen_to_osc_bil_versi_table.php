<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('osc_bil_versi', function (Blueprint $table) {
            $table->string('bl3_nolesen', 50)->nullable()->after('bl3_noakaun')->comment('NO LESEN');
        });
    }

    public function down(): void
    {
        Schema::table('osc_bil_versi', function (Blueprint $table) {
            $table->dropColumn('bl3_nolesen');
        });
    }
};
