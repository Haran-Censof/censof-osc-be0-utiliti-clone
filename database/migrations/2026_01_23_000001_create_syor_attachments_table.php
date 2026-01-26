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
        Schema::create('osc_syor_attachments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('syor_id'); // Links to osc_syor_keputusan.id
            $table->unsignedBigInteger('application_id'); // Links to osc_mhn_permohonan.id
            $table->string('original_name'); // Original filename uploaded by user
            $table->string('stored_name'); // Unique filename stored on server
            $table->string('file_path'); // Relative path to file
            $table->string('mime_type'); // File MIME type (application/pdf, image/jpeg, etc.)
            $table->bigInteger('file_size'); // File size in bytes
            $table->string('uploaded_by')->nullable(); // User who uploaded the file
            $table->timestamps();
            
            // Indexes for better performance
            $table->index(['syor_id']);
            $table->index(['application_id']);
            $table->index(['uploaded_by']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('osc_syor_attachments');
    }
};