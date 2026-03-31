<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration: Create osc_adn_log table for complaint audit trail
 * 
 * Purpose: Track all actions performed on complaints for Jejak Audit display
 * Reference: SDS Jadual 68
 * 
 * Actions tracked:
 * - CIPTA: Ticket submitted
 * - AGIH: Assigned to jabatan
 * - AGIH_SEMULA: Reassigned
 * - TERIMA: Officer accepts
 * - DRAF_BALAS: Draft reply saved
 * - HANTAR_BALAS: Reply formally sent
 * - TUTUP: Ticket closed
 * - BUKA_SEMULA: Ticket reopened
 * - CSAT_HANTAR: CSAT submitted
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('osc_adn_log', function (Blueprint $table) {
            $table->id('log_id')->comment('Primary Key');
            $table->string('log_idpbt', 10)->nullable()->comment('ID PBT');
            $table->string('log_noaduan', 30)->nullable()->comment('NO SIRI ADUAN');
            $table->dateTime('log_tarikh')->nullable()->comment('TARIKH TINDAKAN');
            $table->string('log_pegawai', 100)->nullable()->comment('NAMA PEGAWAI/PELANGGAN');
            $table->string('log_tindakan', 20)->nullable()->comment('JENIS TINDAKAN');
            $table->text('log_catatan')->nullable()->comment('CATATAN TINDAKAN');
            $table->date('log_idate')->nullable()->comment('TARIKH INPUT');
            $table->string('log_iuser', 20)->nullable()->comment('NO KP PEGAWAI KEMASUKAN');
            
            $table->timestamps();
            
            // Foreign key to indaduan table
            $table->foreign(['log_idpbt', 'log_noaduan'], 'fk_log_indaduan')
                ->references(['adn_idpbt', 'adn_noaduan'])
                ->on('osc_adn_indaduan')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            
            // Indexes for performance
            $table->index(['log_idpbt', 'log_noaduan'], 'idx_log_aduan');
            $table->index('log_tarikh', 'idx_log_tarikh');
            $table->index('log_tindakan', 'idx_log_tindakan');
            
            $table->comment('LOG TINDAKAN ADUAN (JEJAK AUDIT)');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('osc_adn_log');
    }
};
