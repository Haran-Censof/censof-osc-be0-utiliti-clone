<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Add ind_almtperniagaan column if it doesn't exist
        if (!Schema::hasColumn('osc_ind_induklesen', 'ind_almtperniagaan')) {
            Schema::table('osc_ind_induklesen', function (Blueprint $table) {
                $table->string('ind_almtperniagaan', 100)
                    ->nullable()
                    ->after('ind_namaperniagaan')
                    ->comment('ALAMAT PERNIAGA');
            });
        }
    }

    public function down(): void
    {
        // Don't drop the column in down migration as it may contain data
    }
};
