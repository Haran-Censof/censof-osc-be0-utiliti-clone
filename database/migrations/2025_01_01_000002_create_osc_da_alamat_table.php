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
        Schema::create('osc_da_alamat', function (Blueprint $table) {
            $table->string('pp_amt_pelangganid', 15)->comment('NO KP / NO SSM / NO PASPORT');
            $table->string('pp_amt_kodsrpbt', 10)->nullable()->comment('KOD ID PBT');
            $table->integer('pp_amt_alamatid')->comment('ALAMAT ID');
            $table->string('pp_amt_alamat01', 100)->nullable()->comment('ALAMAT 1');
            $table->string('pp_amt_alamat02', 100)->nullable()->comment('ALAMAT 2');
            $table->string('pp_amt_alamat03', 100)->nullable()->comment('ALAMAT 3');
            $table->string('pp_amt_poskod', 5)->nullable()->comment('POSKOD');
            $table->string('pp_amt_alamat04', 100)->nullable()->comment('ALAMAT 4');
            $table->string('pp_amt_alamat05', 100)->nullable()->comment('ALAMAT 5');
            $table->string('pp_amt_notelefon', 20)->nullable()->comment('NO TELEFON');
            $table->string('pp_amt_nomborhp', 20)->nullable()->comment('NO TELEFON BIMBIT');
            $table->string('pp_amt_nomborfax', 20)->nullable()->comment('NO FAKS');
            $table->string('pp_amt_email', 50)->nullable()->comment('ALAMAT EMAIL');
            $table->enum('pp_amt_stoversea', ['Y', 'T', 'N'])->default('N')->comment('ALAMAT LUAR NEGARA [Y]-YA [T]-TIDAK [N]-NONE');
            $table->string('pp_amt_jenis', 20)->nullable()->comment('JENIS ALAMAT (HOME, BUSINESS, OFFICE, etc)');
            $table->boolean('pp_amt_default')->default(false)->comment('ALAMAT DEFAULT');

            // Add Laravel timestamps
            $table->timestamps();

            // Add primary key
            $table->primary(['pp_amt_pelangganid', 'pp_amt_alamatid']);

            // Add indexes
            $table->index('pp_amt_pelangganid');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('osc_da_alamat');
    }
};
