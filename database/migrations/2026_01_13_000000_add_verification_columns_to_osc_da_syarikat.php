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
        Schema::table('osc_da_syarikat', function (Blueprint $table) {
            // Add columns that seem to be missing based on Factory and Test usage
            if (!Schema::hasColumn('osc_da_syarikat', 'sykt_jenisniaga')) {
                $table->string('sykt_jenisniaga', 20)->nullable()->comment('JENIS PERNIAGAAN');
            }
            if (!Schema::hasColumn('osc_da_syarikat', 'sykt_kategori')) {
                $table->string('sykt_kategori', 50)->nullable()->comment('KATEGORI SYARIKAT');
            }
            if (!Schema::hasColumn('osc_da_syarikat', 'sykt_tkhdaftar')) {
                $table->date('sykt_tkhdaftar')->nullable()->comment('TARIKH DAFTAR');
            }
            if (!Schema::hasColumn('osc_da_syarikat', 'sykt_authorizedname')) {
                $table->string('sykt_authorizedname', 100)->nullable()->comment('NAMA ORANG YANG DIBENARKAN');
            }
            if (!Schema::hasColumn('osc_da_syarikat', 'sykt_authorizedic')) {
                $table->string('sykt_authorizedic', 20)->nullable()->comment('NO KP ORANG YANG DIBENARKAN');
            }
            if (!Schema::hasColumn('osc_da_syarikat', 'sykt_authorizedjawatan')) {
                $table->string('sykt_authorizedjawatan', 50)->nullable()->comment('JAWATAN ORANG YANG DIBENARKAN');
            }
            
            // SSM Verification fields
            if (!Schema::hasColumn('osc_da_syarikat', 'sykt_ssmverified')) {
                $table->boolean('sykt_ssmverified')->default(false)->comment('SSM VERIFICATION STATUS');
            }
            if (!Schema::hasColumn('osc_da_syarikat', 'sykt_ssmverifiedat')) {
                $table->dateTime('sykt_ssmverifiedat')->nullable()->comment('SSM VERIFICATION TIMESTAMP');
            }
            if (!Schema::hasColumn('osc_da_syarikat', 'sykt_ssmverifyid')) {
                $table->string('sykt_ssmverifyid', 50)->nullable()->comment('SSM VERIFICATION REFERENCE ID');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('osc_da_syarikat', function (Blueprint $table) {
            $table->dropColumn([
                'sykt_jenisniaga',
                'sykt_kategori',
                'sykt_tkhdaftar',
                'sykt_authorizedname',
                'sykt_authorizedic',
                'sykt_authorizedjawatan',
                'sykt_ssmverified',
                'sykt_ssmverifiedat',
                'sykt_ssmverifyid',
            ]);
        });
    }
};
