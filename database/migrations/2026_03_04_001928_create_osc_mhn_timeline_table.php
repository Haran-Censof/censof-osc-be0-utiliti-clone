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
        Schema::create('osc_mhn_timeline', function (Blueprint $table) {
            $table->id();
            $table->string('tl_nosiri', 30)->comment('mhn_nosiri');
            $table->string('tl_idpbt', 10)->comment('mhn_idpbt');
            $table->string('tl_status', 5)->comment('Status code (B, A, U, M, P, L, T, K)');
            $table->string('tl_action', 100)->comment('Human-readable action label');
            $table->text('tl_description')->nullable()->comment('Optional notes');
            $table->string('tl_user', 50)->comment('Who triggered this');
            $table->json('tl_metadata')->nullable()->comment('Extra data (meeting number, agency, etc.)');
            $table->timestamp('tl_created_at')->useCurrent();
            
            $table->index('tl_nosiri');
            $table->index('tl_idpbt');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('osc_mhn_timeline');
    }
};
