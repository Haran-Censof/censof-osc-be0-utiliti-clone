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
        Schema::connection('mysql')->create('osc_mhn_ulasan_review_history', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('uls_id')->comment('Reference to osc_mhn_ulasan.id');
            $table->string('uls_nosiri', 50)->comment('Application serial number');
            $table->enum('uls_status', ['APPROVED', 'REJECTED', 'RESEND'])->comment('Review status');
            $table->string('uls_reviewed_by', 100)->nullable()->comment('Reviewed by (Ketua Jabatan)');
            $table->timestamp('uls_reviewed_at')->nullable()->comment('Review timestamp');
            $table->text('uls_review_remarks')->nullable()->comment('Review remarks/comments');
            $table->string('uls_resent_by', 100)->nullable()->comment('Who resent the ulasan (for RESEND status)');
            $table->timestamp('uls_resent_at')->nullable()->comment('When it was resent (for RESEND status)');
            $table->timestamps();
            
            // Indexes
            $table->index('uls_id');
            $table->index('uls_nosiri');
            $table->index('uls_status');
            $table->index('uls_reviewed_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('mysql')->dropIfExists('osc_mhn_ulasan_review_history');
    }
};
