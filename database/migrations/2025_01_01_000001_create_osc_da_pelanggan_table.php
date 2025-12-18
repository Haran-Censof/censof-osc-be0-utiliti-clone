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
        Schema::create('osc_da_pelanggan', function (Blueprint $table) {
            $table->string('pp_plg_pelangganid', 15)->primary()->comment('NO KP / NO SSM / NO PASPORT');
            $table->string('pp_plg_pelanggannama', 100)->comment('NAMA PELANGGAN');
            $table->enum('pp_plg_pelangganjenis', ['I', 'S'])->comment('[I]-INDIVIDU [S]-SYARIKAT');
            $table->string('pp_plg_tinid', 15)->nullable()->comment('NO PENGENALAN CUKAI LHDN / TIN');
            $table->string('pp_plg_sstid', 20)->nullable()->comment('NO CUKAI DAN PERKHIDMATAN LHDN');
            $table->string('pp_plg_catat', 250)->nullable()->comment('CATATAN');

            // Add Laravel timestamps
            $table->timestamps();

            // Add indexes
            $table->index('pp_plg_pelangganjenis');
        });

        DB::statement("ALTER TABLE osc_da_pelanggan COMMENT='MAKLUMAT PEMOHON'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('osc_da_pelanggan');
    }
};
