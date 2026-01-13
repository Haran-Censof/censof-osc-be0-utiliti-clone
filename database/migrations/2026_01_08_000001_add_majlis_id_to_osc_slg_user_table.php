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
        Schema::table('osc_slg_user', function (Blueprint $table) {
            $table->unsignedBigInteger('majlis_id')->nullable()->after('majlis_code')->comment('FK to osc_kod_majlis.id');
            
            // Optional: Add FK constraint if desired, but user didn't explicitly ask for constraint, just "relationship with osc_kod_majlis.id"
            // Adding FK is safer.
            // $table->foreign('majlis_id')->references('id')->on('osc_kod_majlis');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('osc_slg_user', function (Blueprint $table) {
            $table->dropColumn('majlis_id');
        });
    }
};
