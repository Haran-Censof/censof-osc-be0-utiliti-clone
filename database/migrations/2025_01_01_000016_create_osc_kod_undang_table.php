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
        Schema::create('osc_kod_undang', function (Blueprint $table) {
            $table->id();
            $table->string('und_idpbt', 10)->comment('id pbt');
            $table->string('und_kodundang', 4)->comment('kod undang2 kecil');
            $table->string('und_ketrng1', 100)->nullable()->comment('keterangan1');
            $table->string('und_ketrng2', 100)->nullable()->comment('keterangan2');
            $table->string('und_ketrng3', 100)->nullable()->comment('keterangan3');
            $table->date('und_idate')->nullable();
            $table->date('und_udate')->nullable();
            $table->string('und_iuser', 20)->nullable();
            $table->string('und_uuser', 20)->nullable();

            // Add Laravel timestamps
            $table->timestamps();

            // Add composite unique key
            $table->unique(['und_idpbt', 'und_kodundang'], 'kod_undang_uk');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('osc_kod_undang');
    }
};
