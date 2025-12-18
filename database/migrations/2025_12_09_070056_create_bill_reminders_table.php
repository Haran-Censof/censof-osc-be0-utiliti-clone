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
        Schema::create('bill_reminders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bill_id')->constrained('osc_bil_bayaran', 'bil_id')->onDelete('cascade');
            $table->string('type', 50); // payment_reminder, overdue_notice, etc.
            $table->timestamp('sent_at');
            $table->integer('days_overdue')->nullable();
            $table->json('metadata')->nullable(); // Additional data
            $table->timestamps();

            $table->index(['bill_id', 'type']);
            $table->index('sent_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bill_reminders');
    }
};
