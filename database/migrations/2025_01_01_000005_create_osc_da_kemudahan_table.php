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
        Schema::create('osc_da_kemudahan', function (Blueprint $table) {
            $table->string('pp_kmd_idpelanggan', 15)->comment('NO KP / NO SSM / NO PASPORT');
            $table->string('pp_kmd_kodsrpbt', 10)->comment('KOD ID PBT');
            $table->integer('pp_kmd_alamatid')->comment('ALAMAT ID');
            $table->enum('pp_kmd_modakaun', ['L'])->comment('MODIN [L]-LESEN');
            $table->string('pp_kmd_noakaun', 15)->comment('NO AKAUN LESEN');
            $table->enum('pp_kmd_stathitam', ['Y', 'T'])->nullable()->comment('STATUS DI SENARAI HITAM [Y]- YA [T]-TIDAK');

            // Add Laravel timestamps
            $table->timestamps();

            // Add primary key
            $table->primary(['pp_kmd_idpelanggan', 'pp_kmd_kodsrpbt', 'pp_kmd_alamatid', 'pp_kmd_modakaun', 'pp_kmd_noakaun'], 'pk_osc_da_kemudahan');

            // Add indexes
            $table->index('pp_kmd_idpelanggan');
        });

        DB::statement("ALTER TABLE osc_da_kemudahan COMMENT='MAKLUMAT KEMUDAHAN PELANGGAN'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('osc_da_kemudahan');
    }
};
