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
        Schema::create('syor_keputusan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('application_id');
            $table->enum('syor_jenis', ['SOKONG', 'TIDAK_SOKONG']);
            $table->text('syor_keterangan');
            $table->string('userid', 50); // Track who created the record
            $table->timestamps();
            $table->softDeletes();

            // Indexes
            $table->index('application_id');
            $table->index('syor_jenis');
            $table->index('userid');
            $table->index('created_at');
            $table->index(['application_id', 'created_at']);

            // Foreign key constraint (if applications table exists)
            // Uncomment if you want to enforce referential integrity
            // $table->foreign('application_id')->references('id')->on('applications')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('syor_keputusan');
    }
};