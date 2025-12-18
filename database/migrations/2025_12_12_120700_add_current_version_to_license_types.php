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
        Schema::table('license_types', function (Blueprint $table) {
            $table->unsignedBigInteger('current_version_id')->nullable()->after('id');
            
            $table->foreign('current_version_id')
                ->references('id')
                ->on('license_type_versions')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('license_types', function (Blueprint $table) {
            $table->dropForeign(['current_version_id']);
            $table->dropColumn('current_version_id');
        });
    }
};
