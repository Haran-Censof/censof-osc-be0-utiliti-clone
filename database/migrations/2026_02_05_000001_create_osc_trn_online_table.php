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
        Schema::create('osc_trn_online', function (Blueprint $table) {
            $table->id()->comment('PRIMARY KEY AUTO INCREMENT');

            // Main payment fields based on Oracle DDL
            $table->string('pay_idpbt', 10)->comment('KOD ID PBT');
            $table->string('pay_rowno', 100)->nullable()->comment('ROW NUMBER');
            $table->string('pay_stats', 100)->nullable()->comment('STATUS TRANSAKSI');
            $table->string('pay_tktrx', 100)->nullable()->comment('TARIKH TRANSAKSI');
            $table->string('pay_noodr', 100)->nullable()->comment('NOMBOR ORDER');
            $table->string('pay_bilrb', 100)->nullable()->comment('NOMBOR BIL RB');
            $table->string('pay_modin', 100)->nullable()->comment('MOD INPUT');
            $table->string('pay_noakn', 100)->nullable()->comment('NOMBOR AKAUN');
            $table->string('pay_kpgid', 100)->nullable()->comment('KP/ID PEMBAYAR');
            $table->string('pay_knama', 100)->nullable()->comment('NAMA PEMBAYAR');
            $table->string('pay_nruj1', 100)->nullable()->comment('NOMBOR RUJUKAN 1');
            $table->string('pay_rpgid', 100)->nullable()->comment('RECEIPT PG ID');
            $table->string('pay_rnama', 100)->nullable()->comment('RECEIPT NAMA');
            $table->string('pay_email', 100)->nullable()->comment('EMAIL PEMBAYAR');
            $table->string('pay_notel', 100)->nullable()->comment('NOMBOR TELEFON');
            $table->string('pay_nruj2', 100)->nullable()->comment('NOMBOR RUJUKAN 2');
            $table->string('pay_pdate', 100)->nullable()->comment('PAYMENT DATE');
            $table->string('pay_carts', 100)->nullable()->comment('CART STATUS');
            $table->string('pay_pmode', 100)->nullable()->comment('PAYMENT MODE');
            $table->string('pay_ambyr', 100)->nullable()->comment('AMAUN BAYAR');
            $table->date('pay_tkpos')->nullable()->comment('TARIKH POS');
            $table->string('pay_onama', 10)->nullable()->comment('ONLINE NAMA');
            $table->string('pay_statp', 100)->nullable()->comment('STATUS PAYMENT');
            $table->string('pay_salur', 100)->nullable()->comment('SALURAN PEMBAYARAN');

            // Standard Laravel fields
            $table->timestamps();

            // Indexes
            $table->index('pay_idpbt', 'osc_trn_online_pay_idpbt_index');
            $table->index('pay_noodr', 'osc_trn_online_pay_noodr_index');
            $table->index('pay_stats', 'osc_trn_online_pay_stats_index');
            $table->index(['pay_idpbt', 'pay_noodr'], 'osc_trn_online_composite_index');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('osc_trn_online');
    }
};
