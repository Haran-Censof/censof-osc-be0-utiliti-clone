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
        Schema::create('license_type_versions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('license_type_id');
            $table->integer('version_number');
            
            // Frozen configuration (snapshot)
            $table->string('code', 50);
            $table->string('name', 255);
            $table->string('category', 100)->nullable();
            $table->string('pbt_code', 10)->nullable();
            $table->boolean('is_active')->default(true);
            
            // JSON configurations (frozen snapshots)
            $table->json('form_fields')->nullable();
            $table->json('document_requirements')->nullable();
            $table->json('fee_structure')->nullable();
            $table->json('workflow_rules')->nullable();
            $table->json('eligibility_criteria')->nullable();
            $table->json('standard_conditions')->nullable();
            
            // Metadata
            $table->string('created_by')->nullable();
            $table->text('change_reason')->nullable();
            $table->timestamp('created_at')->useCurrent();
            
            // Foreign keys and indexes
            $table->foreign('license_type_id')
                ->references('id')
                ->on('license_types')
                ->onDelete('cascade');
            
            $table->unique(['license_type_id', 'version_number'], 'unique_version');
            $table->index('license_type_id', 'idx_license_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('license_type_versions');
    }
};
