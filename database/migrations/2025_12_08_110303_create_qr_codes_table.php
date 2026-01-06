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
        Schema::create('qr_codes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('qr_license_id');
            $table->text('qr_code_data')->nullable();
            $table->string('qr_code_signature', 255)->nullable();
            $table->string('qr_code_image_path', 500)->nullable();
            $table->string('qr_verification_url', 500)->nullable();
            $table->timestamps();

            $table->foreign('qr_license_id')->references('id')->on('osc_ind_induklesen');
            $table->index(['qr_license_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('qr_codes');
    }
};
