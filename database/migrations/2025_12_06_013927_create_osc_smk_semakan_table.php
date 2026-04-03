<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     * Review table for BE2 licensing - PPSU screening of applications
     */
    public function up(): void
    {
        Schema::create('osc_smk_semakan', function (Blueprint $table) {
            $table->id('smk_id');
            $table->unsignedBigInteger('smk_idpermohonan'); // Application ID
            $table->string('smk_idppsu')->nullable(); // Assigned PPSU officer
            $table->string('smk_status')->default('PENDING'); // PENDING, IN_PROGRESS, COMPLETED
            $table->string('smk_tahaptahap')->default('MEDIUM'); // Risk level: LOW, MEDIUM, HIGH
            
            $table->dateTime('smk_tarikhagih')->nullable(); // Assignment date
            $table->dateTime('smk_tarikhsiap')->nullable(); // Completion date
            $table->text('smk_catatan')->nullable(); // Notes
            $table->string('smk_syor')->nullable(); // Recommendation
            
            // Audit fields
            $table->dateTime('smk_tarikhcipta')->useCurrent();
            $table->string('smk_ciptaoleh')->default('system');
            $table->dateTime('smk_tarikhmaskini')->useCurrent();
            $table->string('smk_maskiniole')->default('system');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('osc_smk_semakan');
    }
};
