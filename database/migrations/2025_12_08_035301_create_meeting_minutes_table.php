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
        Schema::create('meeting_minutes', function (Blueprint $table) {
            $table->id();
            $table->string('mnt_nomesy', 10)->comment('NO MESYUARAT');
            $table->string('mnt_versi')->default('DRAF')->comment('VERSI: DRAF, AKHIR');
            $table->longText('mnt_kandungan')->comment('KANDUNGAN MINIT DALAM FORMAT BERSTRUKTUR');
            $table->string('mnt_laluanfail')->nullable()->comment('LALUAN KE FAIL PDF YANG DIJANA');
            $table->date('mnt_tkhlulus')->nullable()->comment('BILA MINIT DILULUSKAN');
            $table->unsignedBigInteger('mnt_dilulusoleh')->nullable()->comment('PENGERUSI YANG MELULUSKAN');
            $table->json('mnt_metadata')->nullable()->comment('METADATA TAMBAHAN');
            $table->timestamps();

            $table->foreign('mnt_nomesy')->references('msy_bilangan')->on('osc_smk_mesyuarat');
            $table->foreign('mnt_dilulusoleh')->references('id')->on('osc_usr_profile');
            $table->index(['mnt_nomesy', 'mnt_versi'], 'meeting_minute_version_idx');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meeting_minutes');
    }
};
