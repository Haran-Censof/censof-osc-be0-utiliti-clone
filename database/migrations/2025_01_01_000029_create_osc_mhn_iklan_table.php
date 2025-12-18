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
        Schema::create('osc_mhn_iklan', function (Blueprint $table) {
            $table->string('lan_kdsrpbt', 10)->comment('KOD SIRI PBT');
            $table->decimal('lan_nosiri', 9, 0)->comment('NO SIRI PERMOHONAN');
            $table->decimal('lan_akaun', 7, 0)->nullable()->comment('NO AKAUN LESEN - LEPAS LULUS');
            $table->string('lan_rujuk', 20)->nullable()->comment('RUJUKAN');
            $table->dateTime('lan_mulai')->nullable()->comment('TARIKH MULA');
            $table->dateTime('lan_tamti')->nullable()->comment('TARIKH TAMAT');
            $table->decimal('lan_amaun', 11, 2)->nullable()->comment('AMAUN');
            $table->string('lan_stajn', 1)->nullable()->comment('TANAH KOSONG');
            $table->string('lan_keadn', 1)->nullable()->comment('MELINTANG');
            $table->string('lan_stalp', 1)->nullable()->comment('BERLAMPU');
            $table->string('lan_aktif', 1)->nullable()->comment('AKTIF');
            $table->decimal('lan_panjg', 6, 2)->nullable()->comment('PANJANG');
            $table->decimal('lan_lebar', 6, 2)->nullable()->comment('LEBAR');
            $table->string('lan_tempt', 100)->nullable()->comment('TEMPAT');
            $table->string('lan_keter', 40)->nullable()->comment('KETERANGAN');
            $table->dateTime('lan_batal')->nullable()->comment('BATAL');
            $table->string('lan_statf', 1)->nullable()->comment('STATUS');
            $table->string('lan_onama', 10)->nullable()->comment('NAMA');
            $table->dateTime('lan_idate')->nullable()->comment('TARIKH INPUT');
            $table->dateTime('lan_udate')->nullable()->comment('TARIKH KEMASKINI');

            // Add Laravel timestamps
            $table->timestamps();

            // Add composite primary key
            $table->primary(['lan_kdsrpbt', 'lan_nosiri'], 'pk_osc_mhn_iklan');

            // Add indexes
            $table->index(['lan_kdsrpbt', 'lan_nosiri']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('osc_mhn_iklan');
    }
};
