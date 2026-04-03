<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     * Phase 2: Add file metadata columns to osc_adn_gbraduan
     * 
     * Reason: SRS UC-PL-AD-PA-02-01 & UC-PL-AD-PA-02-02
     * - img_filetype: Store validated MIME type for display and validation
     * - img_filesize: Store file size in bytes for display and limits
     * - img_scan_status: Track virus scan status (optional, for AV scanning)
     */
    public function up(): void
    {
        Schema::table('osc_adn_gbraduan', function (Blueprint $table) {
            // File MIME type (e.g., image/jpeg, application/pdf)
            $table->string('img_filetype', 20)
                ->nullable()
                ->after('img_source')
                ->comment('File MIME type e.g. image/jpeg, application/pdf');
            
            // File size in bytes
            $table->integer('img_filesize')
                ->nullable()
                ->after('img_filetype')
                ->comment('File size in bytes');
            
            // Virus scan status: [P]-Pending [C]-Clean [F]-Flagged
            $table->char('img_scan_status', 1)
                ->default('C')
                ->after('img_filesize')
                ->comment('Scan result: [P]-Pending [C]-Clean [F]-Flagged');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('osc_adn_gbraduan', function (Blueprint $table) {
            $table->dropColumn([
                'img_filetype',
                'img_filesize',
                'img_scan_status',
            ]);
        });
    }
};
