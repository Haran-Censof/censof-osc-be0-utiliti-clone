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
        Schema::create('osc_kod_niaga', function (Blueprint $table) {
            $table->id();
            $table->string('nia_idpbt', 10)->comment('KOD SIRI PBT');
            $table->string('nia_kodundang', 4)->nullable()->comment('KOD UNDANG-UNDANG KECIL');
            $table->string('nia_kodaktiviti', 5)->nullable()->comment('KOD AKTIVITI');
            $table->string('nia_kodniaga1', 2)->comment('KOD NIAGA1');
            $table->string('nia_kodniaga2', 3)->comment('KOD NIAGA2');
            $table->string('nia_kodniaga3', 2)->comment('KOD NIAGA3');
            $table->string('nia_transaksi', 6)->comment('KOD TRANSAKSI / KOD HASIL');
            $table->string('nia_keterangan', 100)->nullable()->comment('KETERANGAN PERNIAGAAN');
            $table->string('nia_ringkas', 70)->nullable()->comment('KETERANGAN RINGKAS PERNIAGAAN');
            $table->decimal('nia_kdrbndr', 9, 2)->nullable()->comment('KADAR LESEN JIKA DIBANDAR');
            $table->decimal('nia_kdrluar', 9, 2)->nullable()->comment('KADAR LESEN JIKA LUAR BANDAR');
            $table->decimal('nia_kdrlain', 9, 2)->nullable()->comment('KADAR LESEN LAIN-LAIN');
            $table->string('nia_stbyrblk', 1)->nullable()->comment('STATUS BAYARAN BALIK');
            $table->string('nia_stdiscnt', 1)->nullable()->comment('STATUS DISCOUNT : REFER CTRL - DISCOUNT');
            $table->string('nia_discount', 3)->nullable()->comment('KADAR DISCOUNT DEFAULT=100%');
            $table->string('nia_risiko', 1)->nullable()->comment('KATEGORI RISIKO PERNIAGAAN : REFER CTRL : RISIKO');
            $table->string('nia_statcgrn', 1)->nullable()->comment('STATUS DIKENAKAN CAGARAN');
            $table->string('nia_halal', 1)->nullable()->comment('STATUS HALAL [Y]-YA [T]-TIDAK');
            $table->tinyInteger('nia_tmpoh')->nullable()->comment('TEMPOH DIAMBIL UNTUK SELESAI SATU PERMOHONAN');
            $table->string('nia_gldebit', 30)->nullable()->comment('KOD GL DEBIT');
            $table->string('nia_glkredit', 30)->nullable()->comment('KOD GL KREDIT');
            $table->date('nia_idate')->nullable();
            $table->date('nia_udate')->nullable();
            $table->string('nia_iuser', 20)->nullable();
            $table->string('nia_uuser', 20)->nullable();

            // Add Laravel timestamps
            $table->timestamps();

            // Add composite unique key
            $table->unique(['nia_idpbt', 'nia_kodaktiviti', 'nia_kodniaga1', 'nia_kodniaga2', 'nia_kodniaga3'], 'kod_niaga_uk');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('osc_kod_niaga');
    }
};
