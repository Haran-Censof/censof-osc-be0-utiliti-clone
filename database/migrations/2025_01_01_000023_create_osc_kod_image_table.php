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
        Schema::create('osc_kod_image', function (Blueprint $table) {
            $table->id();
            $table->string('img_idpbt', 10)->nullable()->comment('id pbt');
            $table->smallInteger('img_imgsiri')->comment('no siri image');
            $table->string('img_imgnama', 60)->nullable()->comment('keterangan');
            $table->longText('img_imgimge')->nullable()->comment('image');
            $table->date('img_idate')->nullable();
            $table->date('img_udate')->nullable();
            $table->string('img_iuser', 20)->nullable();
            $table->string('img_uuser', 20)->nullable();

            // Add Laravel timestamps
            $table->timestamps();

            // Add composite unique key
            $table->unique(['img_idpbt', 'img_imgsiri'], 'kod_image_uk');
            $table->comment('KOD IMAGE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('osc_kod_image');
    }
};
