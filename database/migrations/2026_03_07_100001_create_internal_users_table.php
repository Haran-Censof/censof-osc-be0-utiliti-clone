<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     * Creates internal_users table for officer authentication across all BEs.
     * This table is shared by BE1, BE2, and BE3 for Sanctum authentication.
     */
    public function up(): void
    {
        Schema::create('internal_users', function (Blueprint $table) {
            $table->id();
            $table->string('user_id', 50)->unique()->comment('Unique user identifier');
            $table->string('user_name', 100)->unique()->comment('Username (IC number)');
            $table->string('user_email', 255)->unique()->comment('Email address');
            $table->string('user_password', 255)->comment('Hashed password');
            $table->string('user_group_id', 50)->nullable()->comment('User group');
            $table->char('user_status', 1)->default('A')->comment('A=Active, I=Inactive');
            $table->string('full_name', 255)->comment('Full name');
            $table->string('role', 50)->comment('Role: JKT, PPSU, BTD, ATL, PBT, etc.');
            $table->string('majlis_code', 50)->nullable()->comment('PBT code (null for JKT/central roles)');
            $table->unsignedBigInteger('majlis_id')->nullable()->comment('FK to osc_pbt_majlis.id');
            $table->string('agency_code', 50)->nullable()->comment('Department/agency code');
            $table->boolean('force_password_reset')->default(false);
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamp('user_created')->nullable();
            $table->string('user_iuser', 50)->nullable()->comment('Created by user');
            $table->timestamp('user_updated')->nullable();
            $table->string('user_uuser', 50)->nullable()->comment('Updated by user');
            $table->timestamps();
            
            // Indexes
            $table->index('user_id');
            $table->index('user_name');
            $table->index('user_email');
            $table->index('role');
            $table->index('majlis_code');
            $table->index('majlis_id');
            $table->index('user_status');
            
            // Foreign key (if osc_pbt_majlis exists)
            // $table->foreign('majlis_id')->references('id')->on('osc_pbt_majlis')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('internal_users');
    }
};
