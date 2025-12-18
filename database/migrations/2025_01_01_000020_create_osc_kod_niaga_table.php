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
            $table->string('nia_kdsrpbt', 10)->nullable()->comment('KOD SIRI PBT');
            $table->string('nia_kodundg', 4)->nullable()->comment('KOD UNDANG-UNDANG KECIL');
            $table->string('nia_kodjenis', 2)->nullable()->comment('KOD JENIS');
            $table->string('nia_kodsektor', 5)->nullable()->comment('KOD SEKTOR');
            $table->string('nia_kodaktvti', 5)->nullable()->comment('KOD AKTIVITI');
            $table->string('nia_kodniaga1', 2)->comment('KOD NIAGA1');
            $table->string('nia_kodniaga2', 3)->comment('KOD NIAGA2');
            $table->string('nia_kodniaga3', 2)->comment('KOD NIAGA3');
            $table->string('nia_transaksi', 6)->comment('KOD TRANSAKSI / KOD HASIL');
            $table->string('nia_keterngn', 100)->nullable()->comment('KETERANGAN PERNIAGAAN');
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
            $table->integer('nia_tmpoh')->nullable()->comment('TEMPOH DIAMBIL UNTUK SELESAI SATU PERMOHONAN');
            $table->string('nia_gldebit', 30)->nullable()->comment('KOD GL DEBIT');
            $table->string('nia_glkredit', 30)->nullable()->comment('KOD GL KREDIT');

            // Add Laravel timestamps
            $table->timestamps();

            // Add composite primary key
            $table->primary(['nia_kodniaga1', 'nia_kodniaga2', 'nia_kodniaga3', 'nia_transaksi'], 'pk_osc_kodniaga');

            // Add indexes
            $table->index('nia_kdsrpbt');
            $table->index(['nia_kodniaga1', 'nia_kodniaga2', 'nia_kodniaga3']);
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
