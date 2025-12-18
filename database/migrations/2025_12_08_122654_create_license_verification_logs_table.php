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
        Schema::create('license_verification_logs', function (Blueprint $table) {
            $table->id('verification_id');
            $table->string('license_number', 50)->index();
            $table->string('verification_method', 20)->comment('license_number, qr_code');
            $table->string('ip_address', 45);
            $table->string('user_agent', 500)->nullable();
            $table->boolean('is_successful')->default(true);
            $table->string('failure_reason', 255)->nullable();
            $table->json('request_data')->nullable();
            $table->json('response_data')->nullable();
            $table->timestamps();

            $table->index(['license_number', 'created_at']);
            $table->index(['ip_address', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('license_verification_logs');
    }
};
