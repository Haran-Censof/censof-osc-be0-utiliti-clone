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
        Schema::create('application_processing_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('application_id');
            
            // Workflow Context
            $table->string('step_code', 50);
            $table->string('step_name', 100);
            $table->string('status', 20); // 'pending', 'approved', 'rejected', 'skipped'
            
            // Actor Context
            $table->string('assigned_to_role', 50)->nullable();
            $table->string('processed_by_user_id', 50)->nullable();
            
            // Metadata
            $table->text('comments')->nullable();
            $table->timestamp('processed_at')->nullable();
            $table->timestamp('created_at')->useCurrent();
            
            // Foreign key
            $table->foreign('application_id')
                ->references('mhn_id')
                ->on('osc_mhn_permohonan')
                ->onDelete('cascade');
                
            // Indexes
            $table->index(['application_id', 'step_code'], 'idx_app_step');
            $table->index('status', 'idx_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('application_processing_logs');
    }
};
