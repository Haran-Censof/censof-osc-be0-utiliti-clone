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
            $table->string('skt_kdsrpbt', 10)->comment('id pbt');
            $table->string('skt_kodsektr', 5)->comment('kod sektor');
            $table->string('skt_sktrnama', 100)->nullable()->comment('keterangan');
            $table->string('skt_kdjenis', 2)->nullable()->comment('kod jenis');

            // Add Laravel timestamps
            $table->timestamps();

            // Add composite primary key
            $table->primary(['skt_kdsrpbt', 'skt_kodsektr'], 'pk_osc_kodsektor');

            // Add indexes
            $table->index('skt_kdsrpbt');
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
