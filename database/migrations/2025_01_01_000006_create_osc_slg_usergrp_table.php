<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('osc_slg_usergrp', function (Blueprint $table) {
            $table->string('user_group_id', 10)->comment('USER GROUP ID');
            $table->string('user_group_desc', 255)->comment('USER GROUP DESCRIPTION');
            $table->string('new_group_id', 8)->nullable()->comment('NEW GROUP ID');
            $table->string('user_kaunter', 1)->nullable()->comment('USER KAUNTER');
            $table->string('user_iuser', 20)->nullable()->comment('NO KP PEGAWAI KEMASUKAN');
            $table->string('user_uuser', 20)->nullable()->comment('NO KP PEGAWAI KEMASKINI');

            $table->timestamps();
            $table->primary('user_group_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('osc_slg_usergrp');
    }
};
