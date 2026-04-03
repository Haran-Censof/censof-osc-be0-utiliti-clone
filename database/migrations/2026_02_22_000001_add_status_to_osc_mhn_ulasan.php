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
        Schema::connection('mysql')->table('osc_mhn_ulasan', function (Blueprint $table) {
            // Add status column
            $table->enum('uls_status', ['DRAFT', 'SUBMITTED', 'APPROVED', 'REJECTED'])
                  ->default('SUBMITTED')
                  ->after('uls_ulasan')
                  ->comment('Status ulasan: DRAFT, SUBMITTED, APPROVED, REJECTED');
            
            // Add review fields
            $table->string('uls_reviewed_by', 100)->nullable()->after('uls_status')->comment('Reviewed by (Ketua Jabatan)');
            $table->timestamp('uls_reviewed_at')->nullable()->after('uls_reviewed_by')->comment('Review timestamp');
            $table->text('uls_review_remarks')->nullable()->after('uls_reviewed_at')->comment('Review remarks/comments');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('mysql')->table('osc_mhn_ulasan', function (Blueprint $table) {
            $table->dropColumn(['uls_status', 'uls_reviewed_by', 'uls_reviewed_at', 'uls_review_remarks']);
        });
    }
};
