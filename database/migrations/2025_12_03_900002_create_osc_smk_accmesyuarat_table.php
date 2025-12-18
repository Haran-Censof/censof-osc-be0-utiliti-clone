<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('osc_smk_accmesyuarat', function (Blueprint $table) {
            $table->integer('mja_akaun')->comment('AKAUN');
            $table->tinyInteger('mja_digit')->comment('DIGIT');
            $table->datetime('mja_tkhtk')->nullable()->comment('TARIKH TERAKHIR');
            $table->datetime('mja_tkhpl')->comment('TARIKH PELUPUSAN');
            $table->string('mja_onama', 10)->nullable()->comment('NAMA');
            $table->string('mja_sbkod', 3)->nullable()->comment('KOD SEBAB');
            $table->string('mja_mesej', 100)->nullable()->comment('MESEJ');
            $table->string('mja_statf', 1)->nullable()->comment('STATUS');
            $table->integer('mja_hsiri')->nullable()->comment('SIRI');
            $table->string('mja_stcbk', 1)->comment('STATUS CABIKAN');
            $table->string('mja_sbbtl', 50)->nullable()->comment('SEBAB BATAL');

            $table->timestamps();
            $table->index('mja_akaun');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('osc_smk_accmesyuarat');
    }
};
