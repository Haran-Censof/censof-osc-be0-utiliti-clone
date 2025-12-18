<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('osc_slg_menugrp', function (Blueprint $table) {
            $table->string('menu_group_id', 10)->comment('MENU GROUP ID');
            $table->string('menu_group_desc', 50)->comment('MENU GROUP DESCRIPTION');
            $table->string('menu_group_iuser', 20)->nullable()->comment('NO KP PEGAWAI KEMASUKAN');
            $table->string('menu_group_uuser', 20)->nullable()->comment('NO KP PEGAWAI KEMASKINI');

            $table->timestamps();
            $table->primary('menu_group_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('osc_slg_menugrp');
    }
};
