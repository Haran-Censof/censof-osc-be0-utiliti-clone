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
        Schema::create('sla_alerts', function (Blueprint $table) {
            $table->id();
            $table->string('pbt_code', 10);
            $table->string('application_reference', 50);
            $table->unsignedBigInteger('application_id');
            $table->string('license_type', 100);
            $table->string('current_status', 50);
            $table->integer('sla_target_days');
            $table->integer('elapsed_business_days');
            $table->decimal('sla_percentage', 5, 2); // e.g., 85.50 for 85.5%
            $table->boolean('is_breached')->default(false);
            $table->timestamp('breach_detected_at')->nullable();
            $table->timestamp('alert_sent_at')->nullable();
            $table->string('alert_type', 50); // 'warning', 'breach'
            $table->text('alert_message')->nullable();
            $table->json('alert_recipients')->nullable(); // JSON array of email addresses
            $table->timestamp('resolved_at')->nullable();
            $table->text('resolution_notes')->nullable();
            $table->timestamps();

            $table->index(['pbt_code', 'is_breached']);
            $table->index(['application_id']);
            $table->index(['breach_detected_at']);
            $table->index(['alert_sent_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sla_alerts');
    }
};
