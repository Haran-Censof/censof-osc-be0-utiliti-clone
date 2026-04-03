<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('osc_bil_mesejbil', function (Blueprint $table) {
            $table->id('id')->comment('Primary Key');
            $table->string('msg_idpbt', 10)->nullable()->comment('ID PBT');
            $table->integer('msg_kodmsg')->nullable()->comment('SIRI MESEJ');
            $table->string('msg_ketbaris1', 60)->nullable()->comment('MESEJ ATAS BIL BARIS 1');
            $table->string('msg_ketbaris2', 60)->nullable()->comment('MESEJ ATAS BIL BARIS 2');
            $table->string('msg_ketbaris3', 60)->nullable()->comment('MESEJ ATAS BIL BARIS 3');
            $table->string('msg_ketbaris4', 60)->nullable()->comment('MESEJ ATAS BIL BARIS 4');
            $table->string('msg_ketbaris5', 60)->nullable()->comment('MESEJ ATAS BIL BARIS 5');

            $table->timestamps();
            $table->comment('MESEJ ATAS BIL');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('osc_bil_mesejbil');
    }
};
