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
        Schema::table('osc_smk_mesyuarat', function (Blueprint $table) {
            $table->string('msy_tempat')->nullable()->comment('TEMPAT MESYUARAT');
            $table->time('msy_masa')->nullable()->comment('MASA MESYUARAT');
            $table->integer('msy_max_peserta')->default(0)->comment('BILANGAN PESERTA MAKSIMUM');
            $table->text('msy_catatan')->nullable()->comment('CATATAN MESYUARAT');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('osc_smk_mesyuarat', function (Blueprint $table) {
            $table->dropColumn(['msy_nama', 'msy_tempat', 'msy_masa', 'msy_max_peserta', 'msy_catatan']);
        });
    }
};
