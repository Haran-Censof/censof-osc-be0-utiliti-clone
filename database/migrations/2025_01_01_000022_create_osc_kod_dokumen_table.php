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
            $table->string('osc_kdsrpbt', 10)->comment('id pbt');
            $table->enum('osc_ktegori', ['B', 'T', 'H'])->nullable()->comment('[B]-berisiko [T]-Tidak berisiko [H]-Risiko tinggi');
            $table->string('osc_kddocmt', 5)->comment('kod dokument');
            $table->string('osc_docdesc', 250)->nullable()->comment('keterangan doc');
            $table->string('osc_catatan', 500)->nullable()->comment('catatan');
            $table->enum('osc_statusd', ['M', 'P'])->nullable()->comment('status document [M]-Mandatori [P]-Pilihan');

            // Add Laravel timestamps
            $table->timestamps();

            // Add composite primary key
            $table->primary(['osc_kdsrpbt', 'osc_kddocmt'], 'pk_osc_koddocument');

            // Add indexes
            $table->index('osc_kdsrpbt');
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
