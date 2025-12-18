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
        Schema::create('osc_usr_profile', function (Blueprint $table) {
            $table->string('user_id', 30)->primary()->comment('no kp/ssm/passport');
            $table->string('user_group', 2)->comment('kumpulan pengguna : refer control table : pengguna');
            
            // Authentication fields
            $table->string('user_name', 255)->unique()->comment('username for login (ONLY used for authentication)');
            $table->string('user_password', 255)->comment('bcrypt hashed password (60 chars min)');
            $table->string('user_email', 100)->nullable()->comment('email for password reset and notifications (NOT for login)');
            
            // Metadata
            $table->dateTime('user_created')->nullable()->comment('data diwujudkan');
            $table->enum('user_status', ['A', 'T', 'P', 'L', 'C', 'X'])->default('P')->comment('status: [A]-Active [T]-Inactive [P]-Pending [L]-Locked [C]-Pending Closure [X]-Closed');
            
            // Security & Account Management
            $table->dateTime('user_lastlogin')->nullable()->comment('last successful login timestamp');
            $table->integer('user_failedattempts')->default(0)->comment('count of consecutive failed login attempts');
            $table->dateTime('user_lockeduntil')->nullable()->comment('account locked until this timestamp');
            $table->string('user_resettoken', 100)->nullable()->comment('password reset token');
            $table->dateTime('user_resettokenexpiry')->nullable()->comment('password reset token expiry');

            // Add Laravel timestamps
            $table->timestamps();

            // Add indexes
            $table->index('user_group');
            $table->index('user_email', 'idx_user_email');
            $table->index('user_status', 'idx_user_status');
            $table->index('user_lastlogin', 'idx_user_lastlogin');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('osc_usr_profile');
    }
};
