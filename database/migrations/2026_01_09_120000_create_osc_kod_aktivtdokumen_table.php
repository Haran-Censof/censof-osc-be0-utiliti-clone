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
        Schema::create('osc_kod_aktivtdokumen', function (Blueprint $table) {
            $table->id();
            $table->string('akd_idpbt', 10)->comment('KOD IDPBT');
            $table->string('akd_kodaktiviti', 5)->comment('KOD AKTIVITI LESEN');
            $table->string('akd_kddocmt', 5)->comment('KOD DOKUMEN');
            $table->string('akd_catatan', 200)->nullable()->comment('CATATAN');
            $table->date('akd_idate')->nullable()->comment('TARIKH KEMASUKAN');
            $table->date('akd_udate')->nullable()->comment('TARIKH KEMASKINI');
            $table->string('akd_iuser', 20)->nullable()->comment('ID PEGAWAI KEMASUKAN MAKLUMAT');
            $table->string('akd_uuser', 20)->nullable()->comment('ID PEGAWAI KEMASKINI MAKLUMAT');

            // Add Laravel timestamps
            $table->timestamps();

            // Add indexes for better performance
            $table->index('akd_idpbt');
            $table->index('akd_kodaktiviti');
            $table->index('akd_kddocmt');

            $table->comment('KOD AKTIVITI DAN DOKUMEN DIPERLUKAN');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('osc_kod_aktivtdokumen');
    }
};