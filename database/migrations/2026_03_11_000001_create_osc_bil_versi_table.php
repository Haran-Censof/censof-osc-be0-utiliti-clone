<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('osc_bil_versi')) {
            return;
        }

        Schema::create('osc_bil_versi', function (Blueprint $table) {
            $table->id('id')->comment('Primary Key');
            $table->string('bl3_idpbt', 10)->nullable()->comment('KOD ID PBT');
            $table->integer('bl3_noakaun')->nullable()->comment('NO AKAUN LESEN');
            $table->string('bl3_nolesen', 50)->nullable()->comment('NO LESEN');
            $table->date('bl3_tarikh')->nullable()->comment('TARIKH VERSI');
            $table->string('bl3_status', 1)->default('A')->comment('STATUS VERSI [A]-AKTIF [B]-BATAL');
            $table->date('bl3_tempoh')->nullable()->comment('TEMPOH SAH VERSI');
            $table->string('bl3_stbayar', 1)->default('T')->comment('STATUS BAYARAN [Y]-YA [T]-TIDAK');
            $table->string('bl3_sttanda', 1)->default('T')->comment('STATUS TANDATANGAN DIGITAL [Y]-YA [T]-TIDAK');
            $table->timestamp('bl3_mstanda')->nullable()->comment('MASA TANDATANGAN DIGITAL');
            $table->string('bl3_filepath', 500)->nullable()->comment('SIJIL PATH DALAM REPOSITORI');
            $table->string('bl3_filehash', 128)->nullable()->comment('CHECKSUM FAIL (SHA256/SHA512)');
            $table->text('bl3_sijil')->nullable()->comment('INFO SIJIL CA (JSON)');
            $table->integer('bl3_versi')->default(1)->comment('JEJAK VERSI');
            $table->string('bl3_checksum', 128)->nullable()->comment('HMAC/SHA256 UNTUK QR');
            $table->string('bl3_url', 500)->nullable()->comment('URL PENGESAHAN');
            $table->text('bl3_payloadjson')->nullable()->comment('PAYLOAD JSON LENGKAP');
            $table->text('bl3_payloadbase64')->nullable()->comment('PAYLOAD ENCODED UNTUK QR');
            $table->string('bl3_qr', 500)->nullable()->comment('PATH IMEJ QR');
            $table->integer('bl3_download')->default(0)->comment('BILANGAN MUAT TURUN');
            $table->date('bl3_idate')->nullable()->comment('TARIKH KEMASUKAN');
            $table->date('bl3_udate')->nullable()->comment('TARIKH KEMASKINI');
            $table->string('bl3_iuser', 20)->nullable()->comment('NO KP PEGAWAI KEMASUKAN');
            $table->string('bl3_uuser', 20)->nullable()->comment('NO KP PEGAWAI KEMASKINI');

            $table->timestamps();
            $table->index(['bl3_idpbt', 'bl3_noakaun'], 'idx_bil_versi_pbt_akaun');
            $table->index(['bl3_checksum'], 'idx_bil_versi_checksum');
            $table->index(['bl3_status'], 'idx_bil_versi_status');
            $table->comment('MAKLUMAT VERSI SIJIL LESEN & QR PAYLOAD');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('osc_bil_versi');
    }
};
