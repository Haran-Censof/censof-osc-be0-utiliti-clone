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
        Schema::create('meeting_agendas', function (Blueprint $table) {
            $table->id();
            $table->string('agd_nomesy', 10)->comment('NO MESYUARAT');
            $table->string('agd_tajuk')->comment('TAJUK AGENDA');
            $table->text('agd_penerangan')->nullable()->comment('PENERANGAN AGENDA');
            $table->integer('agd_turutan')->default(0)->comment('TURUTAN PAPARAN');
            $table->string('agd_jenis')->default('CASE')->comment('JENIS: PEMBUKAAN, TETAP, KES, AOB, PENUTUPAN');
            $table->json('agd_metadata')->nullable()->comment('METADATA TAMBAHAN UNTUK ITEM AGENDA');
            $table->timestamps();

            $table->foreign('agd_nomesy')->references('msy_bilangan')->on('osc_smk_mesyuarat');
            $table->index(['agd_nomesy', 'agd_turutan']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meeting_agendas');
    }
};
