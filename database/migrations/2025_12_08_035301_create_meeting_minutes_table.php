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
        Schema::create('meeting_minutes', function (Blueprint $table) {
            $table->id();
            $table->string('minute_meeting_number', 10)->comment('Meeting number reference');
            $table->string('minute_version')->default('DRAFT')->comment('Version: DRAFT, FINAL');
            $table->longText('minute_content')->comment('Minutes content in structured format');
            $table->string('minute_file_path')->nullable()->comment('Path to generated PDF file');
            $table->datetime('minute_approved_at')->nullable()->comment('When minutes were approved');
            $table->string('minute_approved_by')->nullable()->comment('Chairperson who approved');
            $table->json('minute_metadata')->nullable()->comment('Additional metadata');
            $table->timestamps();

            $table->foreign('minute_meeting_number')->references('msy_bilangan')->on('osc_smk_mesyuarat');
            $table->foreign('minute_approved_by')->references('user_id')->on('osc_usr_profile');
            $table->index(['minute_meeting_number', 'minute_version'], 'meeting_minute_version_idx');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meeting_minutes');
    }
};
