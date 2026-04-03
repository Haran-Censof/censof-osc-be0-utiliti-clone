<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * BE2-specific tables for licensing workflow
 * These tables are managed by BE2 but created here for centralized migration
 */
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Recommendations - PPSU recommendations after review consolidation
        Schema::create('recommendations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('recommendation_review_id');
            $table->string('recommendation_type');
            $table->text('recommendation_text')->nullable();
            $table->json('conditions')->nullable();
            $table->string('recommended_by')->nullable();
            $table->dateTime('recommended_at')->nullable();
            $table->string('approved_by')->nullable();
            $table->dateTime('approved_at')->nullable();
            $table->timestamps();
            
            $table->index('recommendation_review_id');
        });

        // Checklist Items - Screening checklist items
        Schema::create('checklist_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('checklist_review_id');
            $table->string('item_name');
            $table->text('item_description')->nullable();
            $table->boolean('is_checked')->default(false);
            $table->string('checked_by')->nullable();
            $table->dateTime('checked_at')->nullable();
            $table->text('notes')->nullable();
            $table->integer('order')->default(0);
            $table->timestamps();
            
            $table->index('checklist_review_id');
        });

        // Site Visits - Site visit schedules and findings
        Schema::create('site_visits', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('site_visit_technical_review_id');
            $table->dateTime('scheduled_date')->nullable();
            $table->string('scheduled_time')->nullable();
            $table->string('officer_id')->nullable();
            $table->string('status')->default('SCHEDULED');
            $table->json('findings')->nullable();
            $table->json('photos')->nullable();
            $table->dateTime('completed_at')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
            
            $table->index('site_visit_technical_review_id');
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('site_visits');
        Schema::dropIfExists('checklist_items');
        Schema::dropIfExists('recommendations');
    }
};
