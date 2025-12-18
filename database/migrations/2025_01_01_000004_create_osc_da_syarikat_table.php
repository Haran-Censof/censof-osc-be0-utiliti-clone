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
        Schema::create('osc_da_syarikat', function (Blueprint $table) {
            $table->string('pa_skt_pelangganid', 15)->primary()->comment('NO SSM');
            $table->string('pa_skt_lhdnsstid', 20)->nullable()->comment('ID SST LHDN');
            $table->string('pa_skt_nodaftarkew', 15)->nullable()->comment('NO DAFTAR KEMENTERIAN KEWANGAN');
            $table->string('pa_skt_nodaftarcidb', 20)->nullable()->comment('NO DAFTAR CIDB');
            $table->string('pa_skt_nodaftarpkk', 20)->nullable()->comment('NO DAFTAR PERTUBUHAN KONTRAKTOR');
            $table->enum('pa_skt_statusbumi', ['Y', 'T'])->nullable()->comment('STATUS BUMIPUTRA [Y]-YA [T]-TIDAK');
            $table->dateTime('pa_skt_tkhmulaniaga')->nullable()->comment('TARIKH MULA NIAGA');
            $table->dateTime('pa_skt_tkhtmtniaga')->nullable()->comment('TARIKH TAMAT NIAGA');
            $table->string('pa_skt_idplgcontact', 15)->nullable()->comment('NO TELEFON PEGAWAI DIHUBUNGI');
            $table->string('pa_skt_contactnama', 100)->nullable()->comment('NAMA PEGAWAI DIHUBUNGI');
            $table->string('pa_skt_jenisniaga', 20)->nullable()->comment('JENIS PERNIAGAAN (SDN_BHD, ENTERPRISE, etc)');
            $table->string('pa_skt_kategori', 50)->nullable()->comment('KATEGORI PERNIAGAAN');
            $table->dateTime('pa_skt_tkhdaftar')->nullable()->comment('TARIKH DAFTAR SSM');
            $table->string('pa_skt_authorizedname', 100)->nullable()->comment('NAMA WAKIL SYARIKAT');
            $table->string('pa_skt_authorizedic', 15)->nullable()->comment('NO KP WAKIL SYARIKAT');
            $table->string('pa_skt_authorizedjawatan', 50)->nullable()->comment('JAWATAN WAKIL SYARIKAT');

            // SSM Verification fields
            $table->boolean('pa_skt_ssmverified')->default(false)->comment('SSM VERIFICATION STATUS');
            $table->dateTime('pa_skt_ssmverifiedat')->nullable()->comment('SSM VERIFICATION TIMESTAMP');
            $table->string('pa_skt_ssmverifyid', 50)->nullable()->comment('SSM VERIFICATION REFERENCE ID');

            // Add Laravel timestamps
            $table->timestamps();
        });

        DB::statement("ALTER TABLE osc_da_syarikat COMMENT='MAKLUMAT SYARIKAT'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('osc_da_syarikat');
    }
};
