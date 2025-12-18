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
        Schema::table('osc_mhn_permohonan', function (Blueprint $table) {
            $table->boolean('mhn_is_withdrawn')->default(false)->after('mhn_sebabditolak')->comment('Application withdrawal status');
            $table->text('mhn_withdrawal_reason')->nullable()->after('mhn_is_withdrawn')->comment('Reason for withdrawal');
            $table->datetime('mhn_withdrawal_date')->nullable()->after('mhn_withdrawal_reason')->comment('Date of withdrawal');
            $table->boolean('mhn_withdrawal_notified')->default(false)->after('mhn_withdrawal_date')->comment('Whether withdrawal notification was sent');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('osc_mhn_permohonan', function (Blueprint $table) {
            $table->dropColumn([
                'mhn_is_withdrawn',
                'mhn_withdrawal_reason',
                'mhn_withdrawal_date',
                'mhn_withdrawal_notified',
            ]);
        });
    }
};
