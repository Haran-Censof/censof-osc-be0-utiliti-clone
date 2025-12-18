<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('osc_ind_induklesen', function (Blueprint $table) {
            // Primary key
            $table->id('ind_id');

            // Core license fields (BE2)
            $table->string('ind_nomborlesen', 50)->unique()->nullable()->comment('License number');
            $table->unsignedBigInteger('ind_idpermohonan')->nullable()->comment('Application ID');
            $table->string('ind_idpelanggan', 15)->nullable()->comment('Customer ID');
            $table->unsignedBigInteger('ind_idjenislesen')->nullable()->comment('License type ID');
            $table->string('ind_status', 50)->nullable()->comment('License status');
            $table->date('ind_tarikhkeluaran')->nullable()->comment('Issue date');
            $table->date('ind_tarikhtamat')->nullable()->comment('Expiry date');
            $table->integer('ind_tempohsah')->nullable()->comment('Validity period (days)');
            $table->json('ind_syaratlesen')->nullable()->comment('License conditions (JSON)');
            $table->string('ind_sijilpath', 255)->nullable()->comment('Certificate file path');
            $table->integer('ind_versi')->default(1)->comment('Version number');
            $table->string('ind_kdsrpbt', 10)->nullable()->comment('PBT code');

            // Audit fields
            $table->datetime('ind_tarikhcipta')->nullable()->comment('Creation date');
            $table->string('ind_ciptaoleh', 100)->nullable()->comment('Created by');
            $table->datetime('ind_tarikhmaskini')->nullable()->comment('Last modified date');
            $table->string('ind_maskiniole', 100)->nullable()->comment('Modified by');

            // Legacy fields (for backward compatibility)
            $table->string('ind_idpbt', 10)->nullable()->comment('KOD ID PBT');
            $table->integer('ind_noakaun')->nullable()->comment('NO AKAUN LESEN - BILA KELULUSAN');
            $table->bigInteger('ind_nosiri')->nullable()->comment('NO SIRI PERMOHONAN');
            $table->string('ind_jenisplg', 1)->nullable()->comment('JENIS PELANGGAN [JENIS_PLG]');
            $table->datetime('ind_tkhmsyuarat')->nullable()->comment('TARIKH MESYUARAT');
            $table->string('ind_ptjpk', 6)->nullable()->comment('KOD PTJPK [KELAS_PTJ]');
            $table->integer('ind_kodlokasi')->nullable()->comment('KOD LOKASI');
            $table->string('ind_namaperniagaan', 100)->nullable()->comment('NAMA PERNIAGAAN');
            $table->string('ind_almtperniagaan', 100)->nullable()->comment('ALAMAT PERNIAGA');
            $table->string('ind_norujukan', 40)->nullable()->comment('RUJUKAN FAIL - BILA KELULUSAN');
            $table->datetime('ind_tkmohon')->nullable()->comment('TARIKH MOHON');
            $table->datetime('ind_tarikhlulus')->nullable()->comment('TARKH LULUS');
            $table->integer('ind_katniaga')->nullable()->comment('KATEGORI PERNIAGAAN [KAT_NOAGA]');
            $table->string('ind_statl', 1)->nullable()->comment('STATUS KELULUSAN PERMOHONAN');
            $table->datetime('ind_tkmula')->nullable()->comment('TARIKH MULA');
            $table->datetime('ind_tktamat')->nullable()->comment('TARIKH TAMAT');
            $table->integer('ind_tempoh')->nullable()->comment('TEMPOH [12] [24] [36] BULAN');
            $table->string('ind_notelefon', 10)->nullable()->comment('NO TELEFON SYARIKAT');
            $table->string('ind_msmula', 10)->nullable()->comment('MASA MULA MENIAGA');
            $table->string('ind_mstamat', 10)->nullable()->comment('MASA TAMAN MENIAGA');
            $table->datetime('ind_idate')->nullable()->comment('TARIKH KEMASUKAN MAKLUMAT');
            $table->datetime('ind_udate')->nullable()->comment('TARIKH KEMASKINI MAKLUMAT');
            $table->string('ind_iuser', 20)->nullable()->comment('NO KP PEGAWAI KEMASUKAN');
            $table->string('ind_uuser', 20)->nullable()->comment('NO KP PEGAWAI KEMASKINI');

            $table->timestamps();

            // Indexes
            $table->index(['ind_kdsrpbt']);
            $table->index(['ind_idpermohonan']);
            $table->index(['ind_idpelanggan']);
            $table->index(['ind_idjenislesen']);
            $table->index(['ind_status']);
            $table->index(['ind_nomborlesen']);
            $table->index(['ind_noakaun']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('osc_ind_induklesen');
    }
};
