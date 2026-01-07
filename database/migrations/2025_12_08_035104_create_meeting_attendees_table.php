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
        Schema::create('meeting_attendees', function (Blueprint $table) {
            $table->id();
            $table->string('att_nomesy', 10)->comment('NO MESYUARAT');
            $table->unsignedBigInteger('att_iduser')->comment('ID PENGGUNA');
            $table->string('att_peranan')->default('AHLI')->comment('PERANAN: PENGERUSI, SETIAUSAHA, AHLI');
            $table->string('att_status')->default('JEMPUTAN')->comment('STATUS: JEMPUTAN, DISAHKAN, HADIR, TIDAK_HADIR');
            $table->string('att_statkonflik', 1)->nullable()->default('T')->comment('STATUS KONFLIK [Y]-YA [T]-TIDAK');
            $table->text('att_alasankonflik')->nullable()->comment('ALASAN KONFLIK KEPENTINGAN');
            $table->timestamps();

            $table->foreign('att_nomesy')->references('msy_bilangan')->on('osc_smk_mesyuarat');
            $table->foreign('att_iduser')->references('id')->on('osc_usr_profile');
            $table->unique(['att_nomesy', 'att_iduser'], 'meeting_attendee_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meeting_attendees');
    }
};
