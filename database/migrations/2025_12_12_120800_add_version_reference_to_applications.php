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
            $table->unsignedBigInteger('license_type_version_id')->nullable()->after('mhn_idjenislesen');
            
            $table->foreign('license_type_version_id')
                ->references('id')
                ->on('license_type_versions')
                ->onDelete('set null');
                
            $table->index('license_type_version_id', 'idx_version');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('osc_mhn_permohonan', function (Blueprint $table) {
            $table->dropForeign(['license_type_version_id']);
            $table->dropIndex('idx_version');
            $table->dropColumn('license_type_version_id');
        });
    }
};
