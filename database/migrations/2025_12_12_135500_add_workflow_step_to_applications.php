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
            $table->string('current_workflow_step', 50)->nullable()->after('mhn_status')
                ->comment('Current active step code from workflow_rules');
                
            $table->index('current_workflow_step', 'idx_workflow_step');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('osc_mhn_permohonan', function (Blueprint $table) {
            $table->dropIndex('idx_workflow_step');
            $table->dropColumn('current_workflow_step');
        });
    }
};
