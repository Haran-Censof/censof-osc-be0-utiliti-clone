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
        Schema::table('account_role', function (Blueprint $table) {
            $table->string('pbt_code', 10)->nullable()->after('assigned_by')->comment('PBT context for role assignment');
            $table->index('pbt_code');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('account_role', function (Blueprint $table) {
            $table->dropIndex(['pbt_code']);
            $table->dropColumn('pbt_code');
        });
    }
};
