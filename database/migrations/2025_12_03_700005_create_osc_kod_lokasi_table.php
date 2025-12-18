<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('osc_kod_lokasi', function (Blueprint $table) {
            $table->string('lok_kodlokasi', 6)->nullable()->comment('kod lokasi');
            $table->string('lok_namalokasi', 100)->nullable()->comment('nama lokasi');
            $table->string('lok_namajalan', 100)->nullable()->comment('nama jalan/taman/kampung');
            $table->string('lok_poskod', 5)->nullable()->comment('poskod');
            $table->datetime('lok_idate')->nullable()->comment('tarikh kemasukan');
            $table->datetime('lok_udate')->nullable()->comment('tarikh kemaskini');
            $table->string('lok_iuser', 20)->nullable()->comment('no kp pegawai kemasukan');
            $table->string('lok_uuser', 20)->nullable()->comment('no kp pegawai kemaskini');
            
            $table->timestamps();
            $table->index('lok_kodlokasi');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('osc_kod_lokasi');
    }
};
