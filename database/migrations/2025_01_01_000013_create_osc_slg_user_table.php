<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('osc_slg_user', function (Blueprint $table) {
            $table->id('id')->comment('Primary Key');
            $table->string('user_group_id', 10)->nullable()->comment('USER GROUP ID');
            $table->string('user_id', 15)->nullable()->comment('USER ID');
            $table->string('user_name', 100)->nullable()->comment('USER NAME');
            $table->string('user_password', 32)->nullable()->comment('USER PASSWORD');
            $table->date('user_created')->nullable()->comment('USER CREATED DATE');
            $table->string('user_status', 1)->nullable()->comment('USER STATUS');
            $table->string('user_pelangganid', 15)->nullable()->comment('USER PELANGGAN ID');
            $table->string('user_iuser', 20)->nullable()->comment('NO KP PEGAWAI KEMASUKAN');
            $table->string('user_uuser', 20)->nullable()->comment('NO KP PEGAWAI KEMASKINI');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('osc_slg_user');
    }
};
