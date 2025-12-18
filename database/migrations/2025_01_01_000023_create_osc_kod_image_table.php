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
            $table->string('img_kdsrpbt', 10)->comment('id pbt');
            $table->integer('img_imgsiri')->comment('no siri image');
            $table->string('img_imgnama', 60)->nullable()->comment('keterangan');
            $table->binary('img_imgimge')->nullable()->comment('image');

            // Add Laravel timestamps
            $table->timestamps();

            // Add composite primary key
            $table->primary(['img_kdsrpbt', 'img_imgsiri'], 'pk_osc_kodimage');

            // Add indexes
            $table->index('img_kdsrpbt');
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
