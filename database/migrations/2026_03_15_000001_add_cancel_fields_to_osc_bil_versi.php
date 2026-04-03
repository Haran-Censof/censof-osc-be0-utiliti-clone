<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Tambah field untuk pembatalan sijil
     */
    public function up(): void
    {
        if (!Schema::hasTable('osc_bil_versi')) {
            return;
        }

        Schema::table('osc_bil_versi', function (Blueprint $table) {
            if (!Schema::hasColumn('osc_bil_versi', 'bl3_sebab_batal')) {
                $table->string('bl3_sebab_batal', 500)->nullable()->after('bl3_status')->comment('Sebab pembatalan sijil');
            }

            if (!Schema::hasColumn('osc_bil_versi', 'bl3_tarikh_batal')) {
                $table->date('bl3_tarikh_batal')->nullable()->after('bl3_sebab_batal')->comment('Tarikh pembatalan');
            }

            if (!Schema::hasColumn('osc_bil_versi', 'bl3_user_batal')) {
                $table->string('bl3_user_batal', 50)->nullable()->after('bl3_tarikh_batal')->comment('User yang membatalkan');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (!Schema::hasTable('osc_bil_versi')) {
            return;
        }

        Schema::table('osc_bil_versi', function (Blueprint $table) {
            $columns = collect(['bl3_sebab_batal', 'bl3_tarikh_batal', 'bl3_user_batal'])
                ->filter(fn (string $column) => Schema::hasColumn('osc_bil_versi', $column))
                ->values()
                ->all();

            if ($columns !== []) {
                $table->dropColumn($columns);
            }
        });
    }
};
