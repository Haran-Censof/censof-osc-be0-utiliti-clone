<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('osc_ind_transbatal', function (Blueprint $table) {
            $table->text('btl_catatan')->nullable()->after('btl_uuser')->comment('CATATAN PEMBATALAN');
        });
    }

    public function down(): void
    {
        Schema::table('osc_ind_transbatal', function (Blueprint $table) {
            $table->dropColumn('btl_catatan');
        });
    }
};
