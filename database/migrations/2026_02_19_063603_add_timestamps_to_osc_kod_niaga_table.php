<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Add Laravel standard timestamps (created_at, updated_at) to osc_kod_niaga table.
     * The existing custom timestamp fields (nia_idate, nia_udate) will be kept for backward compatibility.
     */
    public function up(): void
    {
        Schema::table('osc_kod_niaga', function (Blueprint $table) {
            // Add Laravel standard timestamps
            $table->timestamp('created_at')->nullable()->after('nia_uuser');
            $table->timestamp('updated_at')->nullable()->after('created_at');
        });

        // Copy existing data from custom timestamp fields to Laravel timestamps
        DB::statement('UPDATE osc_kod_niaga SET created_at = nia_idate WHERE nia_idate IS NOT NULL');
        DB::statement('UPDATE osc_kod_niaga SET updated_at = nia_udate WHERE nia_udate IS NOT NULL');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('osc_kod_niaga', function (Blueprint $table) {
            $table->dropColumn(['created_at', 'updated_at']);
        });
    }
};
