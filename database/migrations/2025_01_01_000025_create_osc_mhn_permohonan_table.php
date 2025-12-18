<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('osc_mhn_permohonan', function (Blueprint $table) {
            // Primary key
            $table->id('mhn_id');

            // Core application fields (BE2)
            $table->string('mhn_refno', 50)->unique()->nullable()->comment('Application reference number');
            $table->string('mhn_idpelanggan', 15)->nullable()->comment('Customer ID (FK to BE1)');
            $table->unsignedBigInteger('mhn_idjenislesen')->nullable()->comment('License type ID');
            $table->string('mhn_status', 50)->nullable()->comment('Application status');
            $table->string('mhn_namaperniagaan', 200)->nullable()->comment('Business name');
            $table->json('mhn_alamatpremis')->nullable()->comment('Premise address (JSON)');
            $table->json('mhn_butiroperasi')->nullable()->comment('Operational details (JSON)');
            $table->json('mhn_maklumatsokongan')->nullable()->comment('Supporting information (JSON)');
            $table->decimal('mhn_yuranpermohonan', 15, 2)->nullable()->comment('Application fee');
            $table->datetime('mhn_tarikhhantar')->nullable()->comment('Submission date');
            $table->datetime('mhn_tarikhlulus')->nullable()->comment('Approval date');
            $table->datetime('mhn_tarikhditolak')->nullable()->comment('Rejection date');
            $table->text('mhn_sebabditolak')->nullable()->comment('Rejection reason');
            $table->string('mhn_kdsrpbt', 10)->nullable()->comment('PBT code');
            $table->string('mhn_idpbt', 10)->nullable()->comment('PBT reference ID (for property tests)');

            // Audit fields
            $table->datetime('mhn_tarikhcipta')->nullable()->comment('Creation date');
            $table->string('mhn_ciptaoleh', 100)->nullable()->comment('Created by');
            $table->datetime('mhn_tarikhmaskini')->nullable()->comment('Last modified date');
            $table->string('mhn_maskiniole', 100)->nullable()->comment('Modified by');

            // Legacy fields (for backward compatibility)
            $table->string('mhn_jenismhn', 1)->nullable()->comment('JENIS PERMOHONAN [JENIS_MOHON]');
            $table->string('mhn_jenis', 1)->nullable()->comment('KATEGORI PERMOHONAN [KAT_NIAGA]');
            $table->string('mhn_nama', 100)->nullable()->comment('NAMA');
            $table->string('mhn_alamatpos1', 100)->nullable()->comment('ALAMAT POS 1');
            $table->string('mhn_alamatpos2', 100)->nullable()->comment('ALAMAT POS 2');
            $table->string('mhn_alamatpos3', 100)->nullable()->comment('ALAMAT POS 3');
            $table->string('mhn_alamatpos4', 100)->nullable()->comment('ALAMAT POS 4');
            $table->string('mhn_poskod', 10)->nullable()->comment('POSKOD ALAMAT POS');
            $table->string('mhn_emel', 50)->nullable()->comment('EMEL');
            $table->string('mhn_nomhp', 50)->nullable()->comment('NO HANDPHONE');
            $table->string('mhn_nofax', 50)->nullable()->comment('NO FAX');
            $table->string('mhn_notel', 50)->nullable()->comment('NO TELEFON SYARIKAT');
            $table->integer('mhn_kodlokasi')->nullable()->comment('KOD LOKASI');
            $table->string('mhn_almtniaga1', 100)->nullable()->comment('ALAMAT PERNIAGAAN 1');
            $table->string('mhn_almtniaga2', 100)->nullable()->comment('ALAMAT PERNIAGAAN 2');
            $table->string('mhn_almtniaga3', 100)->nullable()->comment('ALAMAT PERNIAGAAN 3');
            $table->string('mhn_almtniaga4', 100)->nullable()->comment('ALAMAT PERNIAGAAN 4');
            $table->string('mhn_poskod2', 10)->nullable()->comment('POSKOD LOKASI PERNIAGAAN');
            $table->datetime('mhn_tkmohon')->nullable()->comment('TARIKH MOHON');
            $table->string('mhn_statl', 1)->nullable()->comment('STATUS KELULUSAN PERMOHONAN');
            $table->datetime('mhn_tkmula')->nullable()->comment('TARIKH MULA');
            $table->datetime('mhn_tktamat')->nullable()->comment('TARIKH TAMAT');
            $table->integer('mhn_tempoh')->nullable()->comment('TEMPOH [12] [24] [36] BULAN');
            $table->string('mhn_msmula', 10)->nullable()->comment('MASA MULA MENIAGA');
            $table->string('mhn_mstamat', 10)->nullable()->comment('MASA TAMAN MENIAGA');
            $table->string('mhn_jenisplg', 1)->nullable()->comment('JENIS PELANGGAN [JENIS_PLG]');
            $table->bigInteger('mhn_nosiri')->nullable()->comment('NO SIRI PERMOHONAN ONLINE');
            $table->string('mhn_norujukan', 40)->nullable()->comment('RUJUKAN FAIL - BILA KELULUSAN');
            $table->datetime('mhn_tkhmsyuarat')->nullable()->comment('TARIKH MESYUARAT');
            $table->integer('mhn_noakaun')->nullable()->comment('NO AKAUN LESEN - BILA KELULUSAN');
            $table->string('mhn_ptjpk', 2)->nullable()->comment('KOD UNIT');
            $table->datetime('mhn_idate')->nullable()->comment('TARIKH KEMASUKAN');
            $table->datetime('mhn_udate')->nullable()->comment('TARIKH KEMASKINI');
            $table->string('mhn_iuser', 20)->nullable()->comment('NO KP PEGAWAI KEMASUKAN');
            $table->string('mhn_uuser', 20)->nullable()->comment('NO KP PEGAWAI KEMASKINI');

            $table->timestamps();

            // Indexes
            $table->index(['mhn_kdsrpbt']);
            $table->index(['mhn_idpelanggan']);
            $table->index(['mhn_idjenislesen']);
            $table->index(['mhn_status']);
            $table->index(['mhn_refno']);
            $table->index(['mhn_noakaun']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('osc_mhn_permohonan');
    }
};
