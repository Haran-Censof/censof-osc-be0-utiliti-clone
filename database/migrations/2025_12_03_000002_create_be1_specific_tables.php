<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Creates BE1-specific tables that are not part of legacy schema:
     *
     * M1 (Profile) Tables:
     * - otp_verifications: OTP verification for registration/password reset
     * - documents: Document management
     *
     * M11 (Admin) Tables:
     * - roles: Role definitions (11-level hierarchy)
     * - permissions: Permission definitions (module.action.scope format)
     * - role_permission: Role-permission mapping
     * - user_role: Internal user-role mapping (osc_slg_user)
     * - account_role: Customer-role mapping (osc_usr_profile)
     * - password_history: Password history for reuse prevention
     * - parameter_history: System parameter change history
     * - audit_logs: Audit trail for critical operations (immutable)
     * - notifications: User notifications (email, in-app)
     *
     * Authentication:
     * - personal_access_tokens: Laravel Sanctum tokens
     *
     * NOTE: All references updated to use osc_usr_profile (external users)
     * and osc_slg_user (internal users) per 2025-12-03 schema refactoring.
     */
    public function up(): void
    {
        // Create otp_verifications table (M1)
        Schema::create('otp_verifications', function (Blueprint $table) {
            $table->id('otp_id');
            $table->unsignedBigInteger('user_id')->comment('REFERENCE TO id in osc_usr_profile');
            $table->string('otp_code', 6);
            $table->string('otp_purpose', 50)->comment('registration, password_reset, contact_change');
            $table->integer('otp_attempts')->default(0);
            $table->datetime('otp_expiresat');
            $table->datetime('otp_verifiedat')->nullable();
            $table->boolean('otp_isused')->default(false);
            $table->integer('otp_resendcount')->default(0)->comment('Number of times OTP was resent');
            $table->datetime('otp_lastresent')->nullable()->comment('Last time OTP was resent');
            $table->datetime('last_resent_at')->nullable()->comment('Last time OTP was resent');
            $table->string('pending_email', 100)->nullable()->comment('Pending email for contact change');
            $table->string('pending_mobile', 20)->nullable()->comment('Pending mobile for contact change');
            $table->timestamps();

            // Indexes
            $table->index('user_id');
            $table->index('otp_code');
            $table->index(['user_id', 'otp_purpose']);

            // Foreign key
            $table->foreign('user_id')->references('id')->on('osc_usr_profile')->onDelete('cascade');
        });

        // Create documents table (M1)
        Schema::create('documents', function (Blueprint $table) {
            $table->uuid('doc_id')->primary();
            $table->unsignedBigInteger('user_id')->comment('REFERENCE TO id in osc_usr_profile');
            $table->string('doc_type', 50)->comment('SSM_CERT, FORM_9, FORM_24, IC_COPY, etc');
            $table->string('doc_originalname', 255);
            $table->string('doc_storagepath', 500);
            $table->string('doc_mimetype', 50);
            $table->bigInteger('doc_filesize');
            $table->integer('doc_version')->default(1);
            $table->string('doc_uploadedby', 50)->nullable();
            $table->timestamps();

            // Indexes
            $table->index('user_id');
            $table->index('doc_type');

            // Foreign key
            $table->foreign('user_id')->references('id')->on('osc_usr_profile')->onDelete('cascade');
        });

        // Create audit_logs table (M11 - Immutable)
        Schema::create('audit_logs', function (Blueprint $table) {
            $table->id('audit_id');
            $table->string('user_id', 15)->nullable()->comment('REFERENCE TO user_id in osc_usr_profile or osc_slg_user');
            $table->string('action', 100)->comment('create, update, delete, login, logout, approve, reject');
            $table->string('entity_type', 100)->comment('customer, application, user, role, permission, parameter');
            $table->string('entity_id', 50)->nullable();
            $table->json('old_values')->nullable()->comment('Previous values before change');
            $table->json('new_values')->nullable()->comment('New values after change');
            $table->string('ip_address', 45)->nullable();
            $table->string('user_agent', 500)->nullable();
            $table->string('performed_by', 15)->nullable()->comment('User who performed the action');
            $table->timestamps();

            // Indexes
            $table->index('user_id');
            $table->index('action');
            $table->index('entity_type');
            $table->index('created_at');
            $table->index('performed_by');

            // Note: No foreign keys to allow audit logs to persist even if users are deleted
        });

        // Create roles table (M11 structure)
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('role_code', 50)->unique()->comment('Unique role code (e.g., super_admin, ppsu)');
            $table->string('role_name', 100)->comment('Human-readable role name');
            $table->integer('hierarchy_level')->comment('Role hierarchy level (1-11, 1 = highest)');
            $table->text('description')->nullable()->comment('Role description');
            $table->boolean('is_active')->default(true)->comment('Role active status');
            $table->boolean('is_system_role')->default(false)->comment('System role that cannot be deleted');
            $table->timestamps();

            $table->index('role_code');
            $table->index('hierarchy_level');
            $table->index('is_active');
        });

        // Create permissions table (M11 structure)
        Schema::create('permissions', function (Blueprint $table) {
            $table->id();
            $table->string('permission_code', 100)->unique()->comment('Permission code (e.g., users.view.all)');
            $table->string('permission_name', 150)->comment('Human-readable permission name');
            $table->string('module', 50)->comment('Module this permission belongs to');
            $table->string('action', 50)->comment('Action: view, create, update, delete, approve, reject, assign, export');
            $table->string('data_scope', 50)->nullable()->comment('Data scope: own, team, department, all');
            $table->text('description')->nullable()->comment('Permission description');
            $table->boolean('is_active')->default(true)->comment('Permission active status');
            $table->timestamps();

            $table->index('permission_code');
            $table->index('module');
            $table->index('action');
            $table->index('is_active');
        });

        // Create role_permission pivot table
        Schema::create('role_permission', function (Blueprint $table) {
            $table->id();
            $table->foreignId('role_id')->constrained('roles')->onDelete('cascade');
            $table->foreignId('permission_id')->constrained('permissions')->onDelete('cascade');
            $table->timestamps();

            $table->unique(['role_id', 'permission_id']);
        });

        // Create user_role pivot table (links internal users to roles - M11)
        Schema::create('user_role', function (Blueprint $table) {
            $table->id();
            $table->string('user_id', 20)->comment('REFERENCE TO user_id in osc_slg_user (internal users)');
            $table->foreignId('role_id')->constrained('roles')->onDelete('cascade');
            $table->timestamp('assigned_at')->useCurrent();
            $table->string('assigned_by', 20)->nullable()->comment('user_id who assigned the role');
            $table->timestamps();

            $table->unique(['user_id', 'role_id']);
            $table->index('user_id');
            $table->index('assigned_by');

            // Note: No foreign keys to osc_slg_user as it doesn't have unique constraint on user_id
            // Referential integrity maintained at application level
        });

        // Create account_role pivot table (links external users/customers to roles)
        Schema::create('account_role', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('account_id')->comment('REFERENCE TO id in osc_usr_profile (external users)');
            $table->foreignId('role_id')->constrained('roles')->onDelete('cascade');
            $table->timestamp('assigned_at')->useCurrent();
            $table->string('assigned_by', 20)->nullable()->comment('user_id who assigned the role (from osc_slg_user)');
            $table->timestamps();

            $table->unique(['account_id', 'role_id']);
            $table->index('account_id');
            $table->index('assigned_by');

            // Foreign keys
            $table->foreign('account_id')->references('id')->on('osc_usr_profile')->onDelete('cascade');
            // Note: No FK for assigned_by as osc_slg_user doesn't have unique constraint on user_id
        });

        // Create password_history table (M11 - Password reuse prevention)
        Schema::create('password_history', function (Blueprint $table) {
            $table->id();
            $table->string('user_id', 20)->comment('REFERENCE TO user_id in osc_slg_user or osc_usr_profile');
            $table->string('password_hash', 255)->comment('Hashed password');
            $table->timestamp('created_at')->useCurrent();

            // Indexes
            $table->index('user_id');
            $table->index('created_at');

            // Note: No foreign keys to allow history to persist
        });

        // Create parameter_history table (M11 - Parameter change tracking)
        Schema::create('parameter_history', function (Blueprint $table) {
            $table->id();
            $table->integer('parameter_id')->comment('REFERENCE TO para_id in osc_slg_sysparam');
            $table->string('parameter_key', 100)->comment('Parameter key for reference');
            $table->text('old_value')->nullable()->comment('Previous parameter value');
            $table->text('new_value')->comment('New parameter value');
            $table->string('changed_by', 20)->nullable()->comment('user_id who made the change');
            $table->string('change_reason', 500)->nullable()->comment('Reason for change');
            $table->timestamp('changed_at')->useCurrent();

            // Indexes
            $table->index('parameter_id');
            $table->index('parameter_key');
            $table->index('changed_at');
            $table->index('changed_by');

            // Note: No foreign key to osc_slg_sysparam as para_id doesn't have unique constraint
            // Referential integrity maintained at application level
        });

        // Create notifications table (M11 - User notifications)
        Schema::create('notifications', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('type')->comment('Notification class name');
            $table->morphs('notifiable'); // User who receives notification (notifiable_type, notifiable_id)
            $table->text('data')->comment('Notification data (JSON)');
            $table->timestamp('read_at')->nullable()->comment('When notification was read');
            $table->timestamps();

            // Note: morphs() already creates index on notifiable_type and notifiable_id
            $table->index('read_at');
        });

        // NOTE: personal_access_tokens table is now created by
        // 2025_01_01_000099_create_personal_access_tokens_table.php
        // with string ID support for osc_usr_profile id
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // NOTE: personal_access_tokens is managed by separate migration
        Schema::dropIfExists('notifications');
        Schema::dropIfExists('parameter_history');
        Schema::dropIfExists('password_history');
        Schema::dropIfExists('account_role');
        Schema::dropIfExists('user_role');
        Schema::dropIfExists('role_permission');
        Schema::dropIfExists('permissions');
        Schema::dropIfExists('roles');
        Schema::dropIfExists('audit_logs');
        Schema::dropIfExists('documents');
        Schema::dropIfExists('otp_verifications');
    }
};
