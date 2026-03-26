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
        Schema::table('osc_ind_induklesen', function (Blueprint $table) {
            $table->index('ind_akaun');
            $table->index('ind_namaperniagaan');
            $table->index('ind_idpelanggan');
        });

        Schema::table('osc_da_pelanggan', function (Blueprint $table) {
            $table->index('plgn_pelanggannama');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('osc_ind_induklesen', function (Blueprint $table) {
            $table->dropIndex(['ind_akaun']);
            $table->dropIndex(['ind_namaperniagaan']);
            $table->dropIndex(['ind_idpelanggan']);
        });

        Schema::table('osc_da_pelanggan', function (Blueprint $table) {
            $table->dropIndex(['plgn_pelanggannama']);
        });
    }
};
