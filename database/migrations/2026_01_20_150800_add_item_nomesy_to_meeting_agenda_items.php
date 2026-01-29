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
        Schema::table('meeting_agenda_items', function (Blueprint $table) {
            $table->string('item_nomesy', 50)->nullable()->after('item_agenda_id')->comment('Direct reference to meeting number');
            // Adding a foreign key for integrity, optional but recommended
            // $table->foreign('item_nomesy')->references('msy_bilangan')->on('osc_smk_mesyuarat');
            // Usually we add index for performance
            $table->index('item_nomesy');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('meeting_agenda_items', function (Blueprint $table) {
            $table->dropColumn('item_nomesy');
        });
    }
};
