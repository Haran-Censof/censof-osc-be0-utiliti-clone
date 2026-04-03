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
        Schema::create('osc_kod_sektor', function (Blueprint $table) {
            $table->id();
            $table->string('skt_idpbt', 10)->comment('id pbt');
            $table->string('skt_kodsektor', 5)->comment('kod sektor');
            $table->string('skt_sktrnama', 100)->nullable()->comment('keterangan');
            $table->string('skt_kodjenis', 2)->comment('kod jenis');
            $table->date('skt_idate')->nullable();
            $table->date('skt_udate')->nullable();
            $table->string('skt_iuser', 20)->nullable();
            $table->string('skt_uuser', 20)->nullable();

            // Add Laravel timestamps
            $table->timestamps();

            // Add composite unique key
            $table->unique(['skt_idpbt', 'skt_kodsektor', 'skt_kodjenis'], 'kod_sektor_uk');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('osc_kod_sektor');
    }
};
