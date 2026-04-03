<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('osc_bil_versi') || Schema::hasColumn('osc_bil_versi', 'bl3_nolesen')) {
            return;
        }

        Schema::table('osc_bil_versi', function (Blueprint $table) {
            $table->string('bl3_nolesen', 50)->nullable()->after('bl3_noakaun')->comment('NO LESEN');
        });
    }

    public function down(): void
    {
        if (!Schema::hasTable('osc_bil_versi') || !Schema::hasColumn('osc_bil_versi', 'bl3_nolesen')) {
            return;
        }

        Schema::table('osc_bil_versi', function (Blueprint $table) {
            $table->dropColumn('bl3_nolesen');
        });
    }
};
