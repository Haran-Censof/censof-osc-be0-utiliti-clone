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
        Schema::table('osc_mhn_dokumen', function (Blueprint $table) {
            // File Metadata
            $table->string('original_filename')->nullable();
            $table->string('mime_type')->nullable();
            $table->string('hash_sha256')->nullable()->index();
            $table->integer('current_version')->default(1);
            $table->date('expiry_date')->nullable()->index();
            $table->integer('page_count')->nullable();
            
            // Audit & Security
            $table->string('uploaded_by')->nullable();
            $table->dateTime('last_accessed_at')->nullable();
            
            // Process Status
            $table->boolean('is_mandatory')->default(false);
            $table->decimal('quality_score', 5, 2)->nullable();
            $table->string('virus_scan_status')->default('pending'); // pending, clean, infected, failed
            $table->string('ocr_status')->default('pending'); // pending, processing, completed, failed
            $table->text('ocr_text')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('osc_mhn_dokumen', function (Blueprint $table) {
            $table->dropColumn([
                'original_filename',
                'mime_type',
                'hash_sha256',
                'current_version',
                'expiry_date',
                'page_count',
                'uploaded_by',
                'last_accessed_at',
                'is_mandatory',
                'quality_score',
                'virus_scan_status',
                'ocr_status',
                'ocr_text'
            ]);
        });
    }
};
