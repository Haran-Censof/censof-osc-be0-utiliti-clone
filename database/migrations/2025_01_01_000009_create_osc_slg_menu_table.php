<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('osc_slg_menu', function (Blueprint $table) {
            $table->id();
            $table->string('menu_group_id', 10)->comment('MENU GROUP ID');
            $table->string('menu_desc', 50)->comment('MENU DESCRIPTION');
            $table->string('menu_appl_type', 1)->comment('MENU APPLICATION TYPE');
            $table->string('menu_call', 10)->comment('MENU CALL');
            $table->integer('menu_seq')->nullable()->comment('MENU SEQUENCE');
            $table->integer('menu_id')->nullable()->comment('MENU ID');
            $table->string('name_space', 30)->nullable()->comment('NAMESPACE');
            $table->string('action_link', 100)->nullable()->comment('ACTION LINK');
            $table->string('web_control', 1)->nullable()->comment('WEB CONTROL');
            $table->integer('web_seq')->nullable()->comment('WEB SEQUENCE');
            $table->string('web_appl_type', 1)->nullable()->comment('WEB APPLICATION TYPE');
            $table->string('web_menu_call', 10)->nullable()->comment('WEB MENU CALL');
            $table->string('project_name', 50)->nullable()->comment('PROJECT NAME');
            $table->string('menu_icon', 50)->nullable()->comment('MENU ICON');
            $table->char('web_tab', 1)->nullable()->comment('WEB TAB');
            $table->string('web_iuser', 20)->nullable()->comment('NO KP PEGAWAI KEMASUKAN');
            $table->string('web_uuser', 20)->nullable()->comment('NO KP PEGAWAI KEMASKINI');

            $table->timestamps();
            $table->index('menu_group_id');
            $table->index('menu_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('osc_slg_menu');
    }
};
