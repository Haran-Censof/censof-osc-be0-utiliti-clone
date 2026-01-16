<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * SR.01.01 Compliance Migration
 * 
 * Adds:
 * 1. api_keys table - UC-PL-PT-KR-04 (Tetapan Integrasi dan API Key)
 * 2. InternalUser fields - Jadual 19 (jawatan, status_kelulusan)
 */
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // ========================================
        // SR.01.01: Jadual 19 - Pentadbir Sistem fields
        // ========================================
        Schema::table('osc_slg_user', function (Blueprint $table) {
            // Position/title 
            if (!Schema::hasColumn('osc_slg_user', 'jawatan')) {
                $table->string('jawatan', 100)->nullable()->after('role')
                    ->comment('Position/title e.g. Pegawai Pelesenan, Ketua Jabatan');
            }
            
            // Approval status by Datuk Bandar/YDP
            if (!Schema::hasColumn('osc_slg_user', 'status_kelulusan')) {
                $table->enum('status_kelulusan', ['pending', 'approved', 'rejected'])
                    ->default('pending')
                    ->after('jawatan')
                    ->comment('Approval status by Datuk Bandar/YDP');
            }
            
            // Approver info
            if (!Schema::hasColumn('osc_slg_user', 'approved_by')) {
                $table->string('approved_by', 20)->nullable()->after('status_kelulusan')
                    ->comment('User ID of approver (Datuk Bandar/YDP)');
            }
            
            if (!Schema::hasColumn('osc_slg_user', 'approved_at')) {
                $table->timestamp('approved_at')->nullable()->after('approved_by')
                    ->comment('Approval timestamp');
            }
        });

        // ========================================
        // SR.01.01: UC-PL-PT-KR-04 - API Key Management
        // ========================================
        if (!Schema::hasTable('api_keys')) {
            Schema::create('api_keys', function (Blueprint $table) {
                $table->id();
                $table->string('name', 100)->comment('Display name for the API key');
                $table->string('key', 50)->unique()->comment('Public API key (osc_xxxx format)');
                $table->string('secret', 64)->comment('Secret key (SHA256 hash)');
                
                // Integration type
                $table->string('type', 30)->index()
                    ->comment('payment_gateway, identity, company, notification, webhook, custom');
                
                // PBT scope (optional)
                $table->string('pbt_code', 20)->nullable()->index()
                    ->comment('PBT code for scoped access');
                
                // Configuration JSON
                $table->json('config')->nullable()
                    ->comment('Integration-specific configuration');
                
                // Validity
                $table->timestamp('expires_at')->nullable()
                    ->comment('Key expiration date');
                $table->timestamp('last_used_at')->nullable()
                    ->comment('Last usage timestamp');
                $table->boolean('is_active')->default(true)->index()
                    ->comment('Key activation status');
                
                // Key rotation
                $table->timestamp('rotated_at')->nullable()
                    ->comment('Last rotation timestamp');
                $table->string('previous_key', 50)->nullable()
                    ->comment('Previous key for grace period after rotation');
                
                // Audit
                $table->string('created_by', 20)
                    ->comment('User ID who created this key');
                
                $table->timestamps();
                
                // Indexes for lookup
                $table->index(['type', 'pbt_code'], 'idx_type_pbt');
                $table->index(['is_active', 'expires_at'], 'idx_valid_keys');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Remove api_keys table
        Schema::dropIfExists('api_keys');
        
        // Remove InternalUser fields
        Schema::table('osc_slg_user', function (Blueprint $table) {
            $table->dropColumn(['jawatan', 'status_kelulusan', 'approved_by', 'approved_at']);
        });
    }
};
