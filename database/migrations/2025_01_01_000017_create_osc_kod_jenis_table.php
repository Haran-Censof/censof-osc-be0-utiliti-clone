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
        Schema::create('osc_kod_jenis', function (Blueprint $table) {
            $table->id();
            $table->string('jns_idpbt', 10)->comment('id pbt');
            $table->string('jns_kodjenis', 2)->comment('kod jenis');
            $table->string('jns_jnsnama', 100)->nullable()->comment('keterangan');
            $table->string('jns_jnsrgks', 40)->nullable()->comment('keterangan ringkas');
            $table->date('jns_idate')->nullable();
            $table->date('jns_udate')->nullable();
            $table->string('jns_iuser', 20)->nullable();
            $table->string('jns_uuser', 20)->nullable();

            // Add Laravel timestamps
            $table->timestamps();

            // Add composite unique key
            $table->unique(['jns_idpbt', 'jns_kodjenis'], 'kod_jenis_uk');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('osc_kod_jenis');
    }
};
