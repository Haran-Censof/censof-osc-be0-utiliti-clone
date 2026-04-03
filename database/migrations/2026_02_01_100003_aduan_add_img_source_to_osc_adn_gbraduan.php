<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     * Reason: Both complainant and officer (Phase 3) write to the same osc_adn_gbraduan table.
     * Without this column there is no way to separate their files when displaying the complaint detail page.
     * Must exist before any file is uploaded.
     */
    public function up(): void
    {
        Schema::table('osc_adn_gbraduan', function (Blueprint $table) {
            $table->char('img_source', 1)
                ->default('C')
                ->after('img_imgimge')
                ->comment('Source of upload: [C]-Complainant [O]-Officer');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('osc_adn_gbraduan', function (Blueprint $table) {
            $table->dropColumn('img_source');
        });
    }
};
