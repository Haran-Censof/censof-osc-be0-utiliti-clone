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
        Schema::table('meeting_agendas', function (Blueprint $table) {
            $table->string('agenda_meeting_number', 20)->change();
            $table->string('agenda_status')->default('P')->comment('Status: P=Pending, D=Discussed, C=Completed');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('meeting_agendas', function (Blueprint $table) {
            $table->dropColumn('agenda_status');
            $table->string('agenda_meeting_number', 10)->change();
        });
    }
};
