<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     * Status history table for BE2 licensing - audit trail of status changes
     */
    public function up(): void
    {
        Schema::create('status_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('application_id'); // Application ID
            $table->string('old_status')->nullable(); // Previous status
            $table->string('new_status'); // New status
            $table->string('changed_by')->default('system'); // User who made the change
            $table->dateTime('changed_at')->nullable(); // Timestamp of change
            $table->text('reason')->nullable(); // Reason for change
            $table->json('metadata')->nullable(); // Additional metadata
            $table->string('ip_address')->nullable(); // IP address of user
            $table->string('user_agent')->nullable(); // User agent string
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('status_histories');
    }
};
