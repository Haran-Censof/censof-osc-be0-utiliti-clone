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
        Schema::create('osc_mhn_ulasan', function (Blueprint $table) {
            // Primary key
            $table->id('uls_id');

            // Core technical review fields (BE2)
            $table->unsignedBigInteger('uls_idsemakan')->nullable()->comment('Review ID');
            $table->string('uls_jenis', 50)->nullable()->comment('Review type (BTD/ATL)');
            $table->string('uls_jabatan', 100)->nullable()->comment('Department/agency');
            $table->string('uls_idpenyemak')->nullable()->comment('Reviewer ID');
            $table->datetime('uls_tarikhujuk')->nullable()->comment('Referral date');
            $table->datetime('uls_tarikhsiap')->nullable()->comment('Completion date');
            $table->boolean('uls_perlulawatn')->default(false)->comment('Site visit required');
            $table->datetime('uls_tarikhlawatn')->nullable()->comment('Site visit date');
            $table->json('uls_penemuan')->nullable()->comment('Findings (JSON)');
            $table->string('uls_syor', 100)->nullable()->comment('Recommendation');
            $table->string('uls_idketuajabatan')->nullable()->comment('HOD approval');
            $table->datetime('uls_tarikhlulusketua')->nullable()->comment('HOD approval date');
            $table->string('uls_status', 50)->nullable()->comment('Review status');
            $table->text('uls_catatan')->nullable()->comment('Notes');

            // Audit fields
            $table->datetime('uls_tarikhcipta')->nullable()->comment('Creation date');
            $table->string('uls_ciptaoleh', 100)->nullable()->comment('Created by');
            $table->datetime('uls_tarikhmaskini')->nullable()->comment('Last modified date');
            $table->string('uls_maskiniole', 100)->nullable()->comment('Modified by');

            // Legacy fields (for backward compatibility)
            $table->string('uls_kdsrpbt', 10)->nullable()->comment('KOD SIRI PBT');
            $table->decimal('uls_nosiri', 9, 0)->nullable()->comment('NO SIRI PERMOHONAN');
            $table->decimal('uls_akaun', 7, 0)->nullable()->comment('NO AKAUN : LEPAS KELULUSAN');
            $table->string('uls_ulsiri', 8)->nullable()->comment('NO SIRI ULASAN');
            $table->string('uls_ulasan', 250)->nullable()->comment('ULASAN');
            $table->string('uls_pegawai', 100)->nullable()->comment('PENGAWAI MENGULAS');
            $table->dateTime('uls_tkhulas')->nullable()->comment('TARIKH ULASAN DIBUAT');
            $table->dateTime('uls_idate')->nullable()->comment('TARIKH INPUT');
            $table->dateTime('uls_udate')->nullable()->comment('TARIKH KEMASKINI');

            $table->timestamps();

            // Indexes
            $table->index(['uls_idsemakan']);
            $table->index(['uls_jenis']);
            $table->index(['uls_idpenyemak']);
            $table->index(['uls_status']);
            $table->index(['uls_kdsrpbt', 'uls_nosiri']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('osc_mhn_ulasan');
    }
};
