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
        Schema::create('osc_da_individu', function (Blueprint $table) {
            $table->string('pp_idv_pelangganid', 15)->primary()->comment('NO KAD PENGENALAN');
            $table->enum('pp_idv_jenisid', ['A', 'T', 'P'])->nullable()->comment('JENIS PENGENALAN [A]-AWAM [T]-TENTERA [P]-POLIS');
            $table->string('pp_idv_lhdntinid', 14)->nullable()->comment('NO PENGENALAN CUKAI LHDN / TIN');
            $table->string('pp_idv_passpot', 10)->nullable()->comment('NO PASPORT');
            $table->string('pp_idv_gelar', 1)->nullable()->comment('GELARAN - REFER OSC_CONTROLTABLE');
            $table->string('pp_idv_jantina', 1)->nullable()->comment('JANTINA - REFER OSC_CONTROLTABLE');
            $table->string('pp_idv_bangsa', 1)->nullable()->comment('BANGSA - REFER OSC_CONTROLTABLE');
            $table->enum('pp_idv_warganegara', ['Y', 'T'])->nullable()->comment('WARGANEGARA [Y]-YA [T]-TIDAK');
            $table->dateTime('pp_idv_tarikhlahir')->nullable()->comment('TARIKH LAHIR');
            $table->string('pp_idv_pekerjaan', 4)->nullable()->comment('PEKERJAAN');
            $table->string('pp_idv_stperkahwinan', 1)->nullable()->comment('STATUS PERKAHWINAN - REFER OSC_CONTROLTABLE');
            $table->decimal('pp_idv_pendapatan', 12, 2)->nullable()->comment('PENDAPATAN - REFER OSC_CONTROLTABLE');
            $table->string('pp_idv_agama', 1)->nullable()->comment('AGAMA - REFER OSC_CONTROLTABLE');
            $table->enum('pp_idv_okustatus', ['Y', 'T', 'N'])->default('N')->comment('STATUS OKU [Y]-YA [T]-TIDAK [N]-NONE');
            $table->string('pp_idv_idoku', 20)->nullable()->comment('ID OKU');

            // JPN Verification fields
            $table->boolean('pp_idv_jpnverified')->default(false)->comment('JPN VERIFICATION STATUS');
            $table->dateTime('pp_idv_jpnverifiedat')->nullable()->comment('JPN VERIFICATION TIMESTAMP');
            $table->string('pp_idv_jpnverifyid', 50)->nullable()->comment('JPN VERIFICATION REFERENCE ID');
            $table->string('pp_idv_profilephoto', 255)->nullable()->comment('PROFILE PHOTO PATH');

            // Add Laravel timestamps
            $table->timestamps();
        });

        DB::statement("ALTER TABLE osc_da_individu COMMENT='MAKLUMAT INDIVIDU'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('osc_da_individu');
    }
};
