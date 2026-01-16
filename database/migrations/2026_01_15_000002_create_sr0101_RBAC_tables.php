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
        // 1. Roles Table
        if (!Schema::hasTable('roles')) {
            Schema::create('roles', function (Blueprint $table) {
                $table->id();
                $table->string('role_code', 50)->unique();
                $table->string('role_name', 100);
                $table->integer('hierarchy_level')->default(99);
                $table->string('description')->nullable();
                $table->boolean('is_active')->default(true);
                $table->boolean('is_system_role')->default(false);
                $table->timestamps();
            });
        }

        // 2. Permissions Table
        if (!Schema::hasTable('permissions')) {
            Schema::create('permissions', function (Blueprint $table) {
                $table->id();
                $table->string('permission_code', 100)->unique(); // e.g., users.view
                $table->string('permission_name', 100);
                $table->string('module', 50)->index();
                $table->string('action', 50)->index();
                $table->string('data_scope', 50)->nullable(); // e.g., own, all, pbt
                $table->string('description')->nullable();
                $table->boolean('is_active')->default(true);
                $table->timestamps();
            });
        }

        // 3. User Role Pivot Table
        if (!Schema::hasTable('user_role')) {
            Schema::create('user_role', function (Blueprint $table) {
                $table->id();
                // User ID is likely a string from legacy system
                $table->string('user_id', 50)->index(); 
                $table->foreignId('role_id')->constrained('roles')->onDelete('cascade');
                $table->timestamp('assigned_at')->useCurrent();
                $table->string('assigned_by', 50)->nullable();
                $table->timestamps();

                $table->unique(['user_id', 'role_id']);
            });
        }

        // 4. Role Permission Pivot Table
        if (!Schema::hasTable('role_permission')) {
            Schema::create('role_permission', function (Blueprint $table) {
                $table->id();
                $table->foreignId('role_id')->constrained('roles')->onDelete('cascade');
                $table->foreignId('permission_id')->constrained('permissions')->onDelete('cascade');
                $table->timestamps();

                $table->unique(['role_id', 'permission_id']);
            });
        }

        // 5. Audit Logs Table (if not exists)
        if (!Schema::hasTable('audit_logs')) {
            Schema::create('audit_logs', function (Blueprint $table) {
                $table->id('audit_id');
                $table->string('user_id', 50)->nullable()->index();
                $table->string('action', 50)->index();
                $table->string('entity_type', 50)->index();
                $table->string('entity_id', 50)->nullable();
                $table->json('old_values')->nullable();
                $table->json('new_values')->nullable();
                $table->string('ip_address', 45)->nullable();
                $table->text('user_agent')->nullable();
                $table->string('performed_by', 50)->nullable();
                $table->string('pbt_code', 20)->nullable()->index();
                $table->timestamps();
            });
        }

        // 6. OTP Verifications Table (if not exists)
        if (!Schema::hasTable('otp_verifications')) {
            Schema::create('otp_verifications', function (Blueprint $table) {
                $table->id('otp_id');
                $table->string('user_id', 50)->index();
                $table->string('otp_code', 10);
                $table->string('otp_purpose', 50)->index();
                $table->integer('otp_attempts')->default(0);
                $table->integer('otp_resendcount')->default(0);
                $table->timestamp('otp_lastresent')->nullable();
                $table->timestamp('otp_expiresat')->nullable();
                $table->timestamp('otp_verifiedat')->nullable();
                $table->boolean('otp_isused')->default(false);
                $table->string('pending_email', 100)->nullable();
                $table->string('pending_mobile', 20)->nullable();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('otp_verifications');
        Schema::dropIfExists('audit_logs');
        Schema::dropIfExists('role_permission');
        Schema::dropIfExists('user_role');
        Schema::dropIfExists('permissions');
        Schema::dropIfExists('roles');
    }
};
