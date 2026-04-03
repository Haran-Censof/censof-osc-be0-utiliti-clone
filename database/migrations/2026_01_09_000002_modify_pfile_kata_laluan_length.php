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
        Schema::table('osc_usr_profile', function (Blueprint $table) {
            $table->string('pfile_kata_laluan', 255)->change()->comment('KATA LALUAN');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('osc_usr_profile', function (Blueprint $table) {
            $table->string('pfile_kata_laluan', 50)->change()->comment('KATA LALUAN');
        });
    }
};
