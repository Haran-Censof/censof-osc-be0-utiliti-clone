<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('osc_slg_menuctrl', function (Blueprint $table) {
            $table->string('user_group_id', 10)->comment('USER GROUP ID');
            $table->string('menu_group_id', 10)->comment('MENU GROUP ID');
            $table->integer('menu_id')->nullable()->comment('MENU ID');
            $table->integer('menu_seq')->nullable()->comment('MENU SEQUENCE');
            $table->string('user_access', 1)->comment('USER ACCESS');
            $table->string('btn01', 1)->comment('BUTTON 01');
            $table->string('btn02', 1)->comment('BUTTON 02');
            $table->string('btn03', 1)->comment('BUTTON 03');
            $table->string('btn04', 1)->comment('BUTTON 04');
            $table->string('btn05', 1)->comment('BUTTON 05');
            $table->string('btn06', 1)->comment('BUTTON 06');
            $table->string('btn07', 1)->comment('BUTTON 07');
            $table->string('btn08', 1)->comment('BUTTON 08');
            $table->string('btn09', 1)->comment('BUTTON 09');
            $table->string('btn10', 1)->comment('BUTTON 10');
            $table->string('btn11', 1)->comment('BUTTON 11');
            $table->string('btn12', 1)->comment('BUTTON 12');
            $table->string('btn13', 1)->comment('BUTTON 13');
            $table->string('btn14', 1)->comment('BUTTON 14');
            $table->string('btn15', 1)->comment('BUTTON 15');
            $table->string('btn16', 1)->comment('BUTTON 16');
            $table->string('btn17', 1)->comment('BUTTON 17');
            $table->string('iuser', 20)->nullable()->comment('NO KP PEGAWAI KEMASUKAN');
            $table->string('uuser', 20)->nullable()->comment('NO KP PEGAWAI KEMASKINI');

            $table->timestamps();
            $table->index(['user_group_id', 'menu_group_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('osc_slg_menuctrl');
    }
};
