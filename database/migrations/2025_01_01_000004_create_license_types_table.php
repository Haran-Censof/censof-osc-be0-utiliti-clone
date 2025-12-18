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
        // License Types - Master data for license type configuration
        // Managed by BE1 (M11 - System Administration)
        // Used by BE2 for application processing
        Schema::create('license_types', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('name');
            $table->string('category')->nullable();
            $table->string('pbt_code')->nullable();
            $table->boolean('is_active')->default(true);
            $table->json('form_fields')->nullable();
            $table->json('document_requirements')->nullable();
            $table->json('fee_structure')->nullable();
            $table->json('workflow_rules')->nullable();
            $table->timestamps();
            
            $table->index('pbt_code');
            $table->index('is_active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('license_types');
    }
};
