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
        Schema::create('osc_kod_majlis', function (Blueprint $table) {
            $table->string('maj_kdnegri', 2)->nullable()->comment('kod negeri');
            $table->string('maj_nmnegri', 50)->nullable()->comment('nama negeri');
            $table->string('maj_kdsrpbt', 10)->primary()->comment('id pbt');
            $table->string('maj_namapbt', 100)->nullable()->comment('nama pbt');
            $table->string('maj_rgkspbt', 40)->nullable()->comment('keterangan ringkas');
            $table->string('maj_alamat1', 100)->nullable()->comment('alamat1');
            $table->string('maj_alamat2', 100)->nullable()->comment('alamat2');
            $table->string('maj_alamat3', 100)->nullable()->comment('alamat3');
            $table->string('maj_alamat4', 100)->nullable()->comment('alamat4');
            $table->string('maj_telefon', 10)->nullable()->comment('no telefon');
            $table->string('maj_amtemel', 20)->nullable()->comment('alamat emel');
            $table->string('maj_nombfax', 10)->nullable()->comment('nombor fax');
            $table->string('maj_kdsstid', 30)->nullable()->comment('kod id sst');
            $table->string('maj_kdtinid', 30)->nullable()->comment('kod TIN');
            $table->enum('maj_stpinmlk', ['Y', 'T'])->nullable()->comment('status pindah milik [Y]-Ya [T]-Tidak');
            $table->enum('maj_dinamik', ['Y', 'T', 'A'])->nullable()->comment('status lesen dinamik [Y]-Ya [T]-Tidak [A]- Semua');
            $table->enum('maj_prorate', ['Y', 'T'])->nullable()->comment('status prorate dibenarkan [Y]-Ya [T]-Tidak');

            // Add Laravel timestamps
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('osc_kod_majlis');
    }
};
