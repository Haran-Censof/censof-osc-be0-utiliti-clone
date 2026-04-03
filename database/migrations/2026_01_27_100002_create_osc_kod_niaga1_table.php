<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations to create OSC_KOD_NIAGA1 table (missing from MySQL).
     */
    public function up(): void
    {
        Schema::rename('osc_kod_niaga', 'osc_kod_niaga1');

        // Create the osc_kod_niaga1 table to match the Oracle OSC_KOD_NIAGA DDL
        Schema::create('osc_kod_niaga', function (Blueprint $table) {
            $table->bigIncrements('id'); // ID NUMBER(15,0)
            $table->string('nia_idpbt', 10)->nullable()->comment('KOD ID  PBT');
            $table->string('nia_kodundang', 4)->nullable()->comment('KOD UNDANG-UNDANG KECIL');
            $table->string('nia_kodaktiviti', 5)->nullable()->comment('KOD AKTIVITI');
            $table->string('nia_kodniaga', 12)->nullable()->comment('KOD PERNIAGAAN : NIA_KODUNDANG||NIA_KODAKTIVITI||RUNNING NO');
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
            $table->decimal('nia_amauncgrn', 9, 2)->nullable()->comment(''); // No comment in Oracle but exists in DDL
            $table->string('nia_halal', 1)->nullable()->comment('STATUS HALAL [Y]-YA  [T]-TIDAK');
            $table->tinyInteger('nia_tmpoh')->nullable()->comment('TEMPOH DIAMBIL UNTUK SELESAI SATU PERMOHONAN RISKO,TIDAK RISIO DAN KRITIKAL');
            $table->string('nia_gldebit', 30)->nullable()->comment('KOD GL DEBIT');
            $table->string('nia_glkredit', 30)->nullable()->comment('KOD GL KREDIT');
            $table->string('nia_statf', 1)->nullable()->comment('');
            $table->string('nia_oldcode', 20)->nullable()->comment('KOD NIAGA ASAL');
            $table->date('nia_idate')->nullable()->comment('TARIKH KEMASUKAN');
            $table->date('nia_udate')->nullable()->comment('TARIKH KEMASKINI');
            $table->string('nia_iuser', 20)->nullable()->comment('NO KP PEGAWAI KEMASUKAN');
            $table->string('nia_uuser', 20)->nullable()->comment('NO KP PEGAWAI KEMASKINI');

            // No unique constraint in the original Oracle DDL, so not creating any here.
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('osc_kod_niaga');

        Schema::rename('osc_kod_niaga1', 'osc_kod_niaga');
    }
};
