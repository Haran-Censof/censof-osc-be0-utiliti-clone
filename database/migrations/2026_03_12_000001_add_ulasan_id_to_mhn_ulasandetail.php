<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('osc_mhn_ulasandetail', function (Blueprint $table) {
            $table->unsignedBigInteger('ulasan_id')->nullable()->after('id')->comment('Foreign key to osc_mhn_ulasan.id');
            $table->foreign('ulasan_id')->references('id')->on('osc_mhn_ulasan')->onDelete('cascade');
            $table->index('ulasan_id');
        });
    }

    public function down(): void
    {
        Schema::table('osc_mhn_ulasandetail', function (Blueprint $table) {
            $table->dropForeign(['ulasan_id']);
            $table->dropColumn('ulasan_id');
        });
    }
};
