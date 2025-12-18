<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('osc_adn_gbraduan', function (Blueprint $table) {
            $table->string('img_idpbt', 10)->nullable()->comment('ID PBT');
            $table->string('img_noaduan', 16)->nullable()->comment('NO ADUAN/PERTANYAAN');
            $table->integer('img_imgsiri')->nullable()->comment('SIRI GAMBAR');
            $table->string('img_imgnama', 100)->nullable()->comment('CATATAN PADA GAMBAR');
            $table->longText('img_imgimge')->nullable()->comment('GAMBAR');
            $table->datetime('img_idate')->nullable()->comment('TARIKH KEMASUKAN');
            $table->datetime('img_udate')->nullable()->comment('TARIKH KEMASKINI');
            $table->string('img_iuser', 20)->nullable()->comment('NO KP PEGAWAI KEMASUKAN');
            $table->string('img_uuser', 20)->nullable()->comment('NO KP PEGAWAI KEMASKINI');
            
            $table->timestamps();
            $table->index(['img_idpbt', 'img_noaduan']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('osc_adn_gbraduan');
    }
};
