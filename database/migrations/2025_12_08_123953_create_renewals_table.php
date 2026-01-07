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
        Schema::create('renewals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('renewal_license_id');
            $table->unsignedBigInteger('renewal_application_id')->nullable();
            $table->string('renewal_type')->default('standard'); // standard, fast_track
            $table->string('renewal_status')->default('initiated'); // initiated, submitted, under_review, approved, rejected, completed
            $table->timestamp('renewal_initiated_at');
            $table->timestamp('renewal_completed_at')->nullable();
            $table->json('renewal_data')->nullable(); // Prefilled renewal data
            $table->json('eligibility_data')->nullable(); // Eligibility check results
            $table->boolean('fast_track_eligible')->default(false);
            $table->integer('grace_period_days')->default(0);
            $table->decimal('penalty_amount', 10, 2)->default(0);
            $table->decimal('renewal_fee', 10, 2)->default(0);
            $table->text('renewal_notes')->nullable();
            $table->timestamps();

            $table->foreign('renewal_license_id')->references('id')->on('osc_ind_induklesen');
            $table->foreign('renewal_application_id')->references('id')->on('osc_mhn_permohonan');

            $table->index(['renewal_license_id', 'renewal_status']);
            $table->index('renewal_initiated_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('renewals');
    }
};
