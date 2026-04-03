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
            $table->id();
            $table->string('tvt_idpbt', 10)->nullable()->comment('KOD PBT');
            $table->string('tvt_kodaktiviti', 5)->nullable()->comment('KOD AKTIVITI LESEN');
            $table->string('tvt_tvtnama', 200)->nullable()->comment('KETERANGAN');
            $table->string('tvt_kodsektor', 5)->nullable()->comment('KOD SEKTOR');
            $table->date('tvt_idate')->nullable();
            $table->date('tvt_udate')->nullable();
            $table->string('tvt_iuser', 20)->nullable();
            $table->string('tvt_uuser', 20)->nullable();

            // Add Laravel timestamps
            $table->timestamps();
            $table->comment('KOD AKTIVITI');
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
