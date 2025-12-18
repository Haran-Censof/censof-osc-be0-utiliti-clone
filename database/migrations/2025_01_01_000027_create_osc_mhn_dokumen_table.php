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
        Schema::create('osc_mhn_dokumen', function (Blueprint $table) {
            $table->id('dok_id'); // Add standard ID mapped to dok_id
            $table->string('doc_kdsrpbt', 10)->nullable()->comment('KOD SIRI PBT');
            $table->decimal('doc_nosiri', 9, 0)->nullable()->comment('NO SIRI PERMOHONAN');
            $table->decimal('doc_akaun', 7, 0)->nullable()->comment('NO AKAUN : SELEPAS KELULUSAN');
            $table->decimal('doc_dcsiri', 3, 0)->nullable()->comment('NO SIRI DOKUMEN');
            $table->binary('doc_dokumen')->nullable()->comment('IMAGE DOKUMEN');
            $table->string('doc_catatan', 250)->nullable()->comment('CATATAN KEPADA DOKUMEN');
            $table->dateTime('doc_idate')->nullable()->comment('TARIKH INPUT');
            $table->dateTime('doc_udate')->nullable()->comment('TARIKH KEMASKINI');

            // Modern Columns (BE2 support)
            $table->unsignedBigInteger('mhn_idpermohonan')->nullable()->index();
            $table->string('dok_jenis')->nullable();
            $table->string('dok_nama')->nullable();
            $table->string('dok_path')->nullable();
            $table->integer('dok_saiz')->nullable();
            $table->string('dok_status')->nullable();
            $table->string('dok_catatan')->nullable();
            $table->unsignedBigInteger('doc_query_id')->nullable();
            $table->unsignedBigInteger('doc_technical_review_id')->nullable();

            // Add Laravel timestamps
            $table->timestamps();

            // Add indexes instead of Primary Key
            $table->index(['doc_kdsrpbt', 'doc_nosiri', 'doc_dcsiri'], 'idx_legacy_pk');
            $table->index(['doc_kdsrpbt', 'doc_nosiri']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('osc_mhn_dokumen');
    }
};
