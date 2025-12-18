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
        Schema::create('osc_kod_aktiviti', function (Blueprint $table) {
            $table->string('tvt_kdsrpbt', 10)->comment('KOD PBT');
            $table->string('tvt_kdktvti', 5)->comment('KOD AKTIVITI LESEN');
            $table->string('tvt_tvtnama', 200)->nullable()->comment('KETERANGAN');
            $table->string('tvt_kodsektr', 5)->nullable()->comment('KOD SEKTOR');

            // Add Laravel timestamps
            $table->timestamps();

            // Add composite primary key
            $table->primary(['tvt_kdsrpbt', 'tvt_kdktvti'], 'pk_osc_kodaktiviti');

            // Add indexes
            $table->index('tvt_kdsrpbt');
            $table->index(['tvt_kdsrpbt', 'tvt_kodsektr']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('osc_kod_aktiviti');
    }
};
