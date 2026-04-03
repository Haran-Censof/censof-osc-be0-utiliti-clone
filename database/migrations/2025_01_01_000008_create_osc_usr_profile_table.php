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
        Schema::create('osc_usr_profile', function (Blueprint $table) {
            $table->id('id')->comment('Primary Key');
            $table->string('pfile_idpbt', 10)->nullable()->comment('KOD ID  PBT');
            $table->string('pfile_kumpulan', 2)->nullable()->comment('KUMPULAN PENGGUNA : refer ctl :pengguna');
            $table->string('pfile_jenis', 2)->nullable()->comment('JENIS PENGGUNA : refer ctl : jenis_plg');
            $table->string('pfile_plgid', 20)->nullable()->comment('NO IC/SSM/PASSPORT DLL');
            $table->string('pfile_nama', 100)->nullable()->comment('NAMA');
            $table->string('pfile_emel', 50)->nullable()->comment('EMEL');
            $table->string('pfile_kata_laluan', 50)->nullable()->comment('KATA LALUAN');
            $table->string('pfile_sah_ktlaluan', 50)->nullable()->comment('PENGESAHAN KATA LALUAN');
            $table->string('pfile_nomhp', 50)->nullable()->comment('NO TELEFON BIMBIT');
            $table->string('pfile_oversea', 1)->default('T')->nullable()->comment('STATUS OVERSEA [Y}:YA    [T]: [TIDAK]');
            $table->string('pfile_alamat1', 100)->nullable()->comment('ALAMAT 1');
            $table->string('pfile_alamat2', 100)->nullable()->comment('ALAMAT 2');
            $table->string('pfile_alamat3', 100)->nullable()->comment('ALAMAT 3');
            $table->string('pfile_alamat4', 100)->nullable()->comment('ALAMAT 4');
            $table->string('pfile_poskod', 10)->nullable()->comment('POSKOD');
            $table->string('pfile_bandar', 2)->nullable()->comment('BANDAR');
            $table->string('pfile_negeri', 2)->nullable()->comment('NEGERI');
            $table->string('pfile_kaedah_sah', 1)->nullable()->comment('KAEDAH PENGESAHAN : refer ctl : KAEDAH_SAH');
            $table->string('pfile_pengesahan1', 2)->nullable()->comment('SOALAN KESELAMATAN 1 : refer ctl : SOALAN_SAH');
            $table->string('pfile_pengesahan2', 2)->nullable()->comment('SOALAN KESELAMATAN 2: refer ctl : SOALAN_SAH');
            $table->string('pfile_jwpn_pengesahan1', 100)->nullable()->comment('JAWAPAN SOALAN KESELAMATAN 1');
            $table->string('pfile_jwpn_pengesahan2', 100)->nullable()->comment('JAWAPAN SOALAN KESELAMATAN 2');
            $table->date('pfile_idate')->nullable()->comment('TARIKH INPUT MAKLUMAT');
            $table->date('pfile_udate')->nullable()->comment('TARIKH KEMASKINI MAKLUMAT');
            $table->string('pfile_statpemohon', 1)->default('Y')->nullable()->comment('PENGGUNA ADALAH PEMOHON [Y]:YA [T]:TIDAK');
            $table->string('pfile_warganegara', 1)->nullable()->comment('STATUS WARGANEGARA [Y]:YA [T]:TIDAK');
            $table->string('pfile_iuser', 20)->nullable()->comment('NO KP PEGAWAI KEMASUKAN');
            $table->string('pfile_uuser', 20)->nullable()->comment('NO KP PEGAWAI KEMASKINI');

            $table->timestamps();
            $table->unique(['pfile_idpbt', 'pfile_kumpulan', 'pfile_plgid'], 'usr_profile_uk');
            $table->comment('MAKLUMAT PENGGUNA APLIKASI OSC PELESENAN');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('osc_usr_profile');
    }
};
