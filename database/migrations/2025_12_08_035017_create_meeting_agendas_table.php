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
        Schema::create('meeting_agendas', function (Blueprint $table) {
            $table->id();
            $table->string('agenda_meeting_number', 10)->comment('Meeting number reference');
            $table->string('agenda_title')->comment('Agenda title');
            $table->text('agenda_description')->nullable()->comment('Agenda description');
            $table->integer('agenda_order')->default(0)->comment('Display order');
            $table->string('agenda_type')->default('CASE')->comment('Type: OPENING, STANDING, CASE, AOB, CLOSING');
            $table->json('agenda_metadata')->nullable()->comment('Additional metadata for agenda item');
            $table->timestamps();

            $table->foreign('agenda_meeting_number')->references('msy_bilangan')->on('osc_smk_mesyuarat');
            $table->index(['agenda_meeting_number', 'agenda_order']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meeting_agendas');
    }
};
