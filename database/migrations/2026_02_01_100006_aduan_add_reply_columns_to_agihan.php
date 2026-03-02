<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * - agh_tkhbalas: Date when reply was sent to complainant (gate for visibility)
     * - agh_balas_iuser: Audit trail - who sent the official reply
     */
    public function up(): void
    {
        Schema::table('osc_adn_agihan', function (Blueprint $table) {
            $table->date('agh_tkhbalas')
                ->nullable()
                ->after('agh_tkhulasan')
                ->comment('Tarikh balas dihantar - SRS UC-PL-AD-PA-03-01');
            
            $table->string('agh_balas_iuser', 20)
                ->nullable()
                ->after('agh_tkhbalas')
                ->comment('NO KP pegawai yang hantar balas - Audit trail');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('osc_adn_agihan', function (Blueprint $table) {
            $table->dropColumn([
                'agh_tkhbalas',
                'agh_balas_iuser'
            ]);
        });
    }
};
