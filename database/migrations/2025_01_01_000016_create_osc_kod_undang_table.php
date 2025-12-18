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
            $table->string('und_kdsrpbt', 10)->comment('id pbt');
            $table->string('und_kodundg', 4)->comment('kod undang2 kecil');
            $table->string('und_ketrng1', 100)->nullable()->comment('keterangan1');
            $table->string('und_ketrng2', 100)->nullable()->comment('keterangan2');
            $table->string('und_ketrng3', 100)->nullable()->comment('keterangan3');

            // Add Laravel timestamps
            $table->timestamps();

            // Add composite primary key
            $table->primary(['und_kdsrpbt', 'und_kodundg'], 'pk_osc_kodundang');

            // Add indexes
            $table->index('und_kdsrpbt');
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
