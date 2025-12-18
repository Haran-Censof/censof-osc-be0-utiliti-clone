<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('osc_slg_user', function (Blueprint $table) {
            $table->string('user_group_id', 10)->comment('USER GROUP ID');
            $table->string('user_id', 15)->primary()->comment('USER ID');
            $table->string('user_name', 50)->nullable()->comment('USER NAME');
            $table->string('user_email', 100)->nullable()->comment('USER EMAIL ADDRESS');
            $table->string('user_password', 255)->nullable()->comment('USER PASSWORD - BCRYPT HASH');
            $table->datetime('user_created')->nullable()->comment('USER CREATED DATE');
            $table->string('user_status', 1)->nullable()->comment('USER STATUS');
            $table->string('user_pelangganid', 15)->nullable()->comment('USER PELANGGAN ID');
            $table->string('user_iuser', 20)->nullable()->comment('NO KP PEGAWAI KEMASUKAN');
            $table->string('user_uuser', 20)->nullable()->comment('NO KP PEGAWAI KEMASKINI');

            // Security & Account Management (added for password policy enforcement)
            $table->integer('user_failedattempts')->default(0)->comment('count of consecutive failed login attempts');
            $table->dateTime('user_lockeduntil')->nullable()->comment('account locked until this timestamp');

            $table->timestamps();
            // Primary key is defined inline
            $table->index('user_group_id');
            $table->index('user_status');
            $table->index('user_email');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('osc_slg_user');
    }
};
