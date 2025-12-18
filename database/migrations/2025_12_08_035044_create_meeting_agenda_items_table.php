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
        Schema::create('meeting_agenda_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('item_agenda_id')->comment('Reference to meeting_agendas table');
            $table->string('item_application_reference')->nullable()->comment('Application reference number');
            $table->string('item_presenter')->nullable()->comment('PPSU presenter ID');
            $table->integer('item_allocated_time')->default(15)->comment('Allocated time in minutes');
            $table->integer('item_order')->default(0)->comment('Order within agenda');
            $table->string('item_status')->default('PENDING')->comment('Status: PENDING, PRESENTED, DEFERRED');
            $table->json('item_metadata')->nullable()->comment('Additional item metadata');
            $table->timestamps();

            $table->foreign('item_agenda_id')->references('id')->on('meeting_agendas');
            $table->index(['item_agenda_id', 'item_order']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meeting_agenda_items');
    }
};
