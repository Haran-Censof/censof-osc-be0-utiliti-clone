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
        Schema::table('site_visits', function (Blueprint $table) {
            // Add monitoring specific fields
            $table->unsignedBigInteger('license_id')->nullable()->after('site_visit_technical_review_id');
            $table->string('visit_type')->nullable()->after('status');
            $table->string('business_status')->nullable()->after('visit_type');
            $table->boolean('is_compounded')->default(false)->after('business_status');
            $table->date('next_visit_date')->nullable()->after('is_compounded');
            
            // Allow technical review ID to be null for standalone monitoring visits
            $table->unsignedBigInteger('site_visit_technical_review_id')->nullable()->change();

            // Foreign key to licenses table
            $table->foreign('license_id')->references('id')->on('osc_ind_induklesen')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('site_visits', function (Blueprint $table) {
            $table->dropForeign(['license_id']);
            $table->dropColumn([
                'license_id',
                'visit_type',
                'business_status',
                'is_compounded',
                'next_visit_date'
            ]);
            
            // Revert back to not nullable if that was the original state
            // Note: If there are records without technical_review_id, this might fail
            $table->unsignedBigInteger('site_visit_technical_review_id')->nullable(false)->change();
        });
    }
};
