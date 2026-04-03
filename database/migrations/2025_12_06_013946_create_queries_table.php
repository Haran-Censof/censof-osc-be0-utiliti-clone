<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     * Queries table for BE2 licensing - deficiency/query management
     */
    public function up(): void
    {
        Schema::create('queries', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('query_application_id'); // Application ID
            $table->unsignedBigInteger('query_review_id'); // Review ID
            $table->string('query_type'); // Query type (DOCUMENT, INFORMATION, CLARIFICATION)
            $table->text('query_text'); // Query description
            $table->json('query_deficiencies')->nullable(); // List of deficiencies
            $table->string('query_issued_by')->nullable(); // Officer who issued query
            $table->dateTime('query_issued_at')->nullable(); // Query issue date
            $table->dateTime('query_deadline')->nullable(); // Response deadline
            $table->text('query_response_text')->nullable(); // Applicant response
            $table->dateTime('query_response_at')->nullable(); // Response date
            $table->string('query_status')->default('PENDING'); // Query status
            $table->integer('query_cycle')->default(1); // Query cycle number (1, 2, 3)
            $table->string('query_resolved_by')->nullable(); // Officer who resolved query
            $table->dateTime('query_resolved_at')->nullable(); // Resolution date
            $table->text('query_resolution_notes')->nullable(); // Resolution notes
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('queries');
    }
};
