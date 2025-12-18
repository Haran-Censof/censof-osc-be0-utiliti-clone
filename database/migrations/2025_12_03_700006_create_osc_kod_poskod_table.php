<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('osc_kod_poskod', function (Blueprint $table) {
            $table->string('pos_poskd', 5)->comment('KOD POSKOD');
            $table->string('pos_bndar', 50)->nullable()->comment('BANDAR');
            $table->string('pos_negri', 2)->comment('KOD NEGERI');
            $table->datetime('pos_idate')->nullable()->comment('TARIKH KEMASUKAN');
            $table->datetime('pos_udate')->nullable()->comment('TARIKH KEMASKINI');
            $table->string('pos_iuser', 20)->nullable()->comment('NO KP PEGAWAI KEMASUKAN');
            $table->string('pos_uuser', 20)->nullable()->comment('NO KP PEGAWAI KEMASKINI');
            
            $table->timestamps();
            $table->primary(['pos_poskd', 'pos_negri']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('osc_kod_poskod');
    }
};
