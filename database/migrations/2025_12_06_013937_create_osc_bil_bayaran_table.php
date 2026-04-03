<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Bill table for BE2 licensing - payment billing
     */
    public function up(): void
    {
        Schema::create('osc_bil_bayaran', function (Blueprint $table) {
            $table->id('bil_id');
            $table->string('bil_nombor')->unique();
            $table->unsignedBigInteger('bil_idpermohonan'); 

            $table->string('bil_jenis'); // Bill type: APPLICATION, RENEWAL, etc.
            $table->decimal('bil_yuranasas', 10, 2)->default(0); // Base fee
            $table->decimal('bil_larasansaiz', 10, 2)->default(0); // Size adjustment
            $table->decimal('bil_dendalewat', 10, 2)->default(0); // Late penalty
            $table->decimal('bil_jumlah', 10, 2); // Total amount

            $table->string('bil_status')->default('UNPAID'); // Status
            $table->dateTime('bil_tarikhjanaan'); // Generation date
            $table->dateTime('bil_tarikhtempoh'); // Due date

            $table->text('bil_keterangan')->nullable(); // Description
            $table->json('bil_pecahan')->nullable(); // Fee breakdown

            // Audit fields
            $table->dateTime('bil_tarikhcipta')->useCurrent();
            $table->string('bil_ciptaoleh')->default('system');
            $table->dateTime('bil_tarikhmaskini')->useCurrent();
            $table->string('bil_maskiniole')->default('system');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('osc_bil_bayaran');
    }
};
