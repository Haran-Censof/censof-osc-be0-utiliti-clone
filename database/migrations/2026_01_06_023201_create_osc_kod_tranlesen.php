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
        Schema::create('osc_kod_tranlesen', function (Blueprint $table) {
            $table->id();
            $table->string('trx_idpbt', 10);
            $table->string('trx_transaksi', 6);
            $table->string('trx_keterangan', 100);
            $table->string('trx_koddebit', 24);
            $table->string('trx_kodkredit', 24);
            $table->date('trx_idate')->nullable();
            $table->date('trx_udate')->nullable();
            $table->string('trx_iuser', 20)->nullable();
            $table->string('trx_uuser', 20)->nullable();

            $table->timestamps();
            $table->unique(['trx_idpbt', 'trx_transaksi'], 'kod_tranlesen_uk');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('osc_kod_tranlesen');
    }
};
