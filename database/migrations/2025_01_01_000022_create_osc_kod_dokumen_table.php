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
        Schema::create('osc_kod_dokumen', function (Blueprint $table) {
            $table->id();
            $table->string('doc_idpbt', 10)->nullable()->comment('id pbt');
            $table->char('doc_ktegori', 1)->nullable()->comment('[B]-berisiko [T]-Tidak berisiko [H]-Risiko tinggi');
            $table->string('doc_kddocmt', 5)->nullable()->comment('kod dokument');
            $table->string('doc_docdesc', 250)->nullable()->comment('keterangan doc');
            $table->string('doc_catatan', 500)->nullable()->comment('catatan');
            $table->string('doc_statusd', 1)->nullable()->comment('status document [M]-Mandatori [P]-Pilihan');
            $table->char('doc_jenismhn', 1)->nullable();
            $table->date('doc_idate')->nullable();
            $table->date('doc_udate')->nullable();
            $table->string('doc_iuser', 20)->nullable();
            $table->string('doc_uuser', 20)->nullable();

            // Add Laravel timestamps
            $table->timestamps();
            $table->comment('MAKLUMAT DOKUMEN');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('osc_kod_dokumen');
    }
};
