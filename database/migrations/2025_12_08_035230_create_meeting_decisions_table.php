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
        Schema::create('meeting_decisions', function (Blueprint $table) {
            $table->id();
            $table->string('decision_meeting_number', 20)->comment('Meeting number reference');
            $table->unsignedBigInteger('decision_agenda_item_id')->comment('Reference to agenda item');
            $table->string('decision_application_reference')->nullable()->comment('Application reference');
            $table->string('decision_type')->comment('Type: APPROVED, REJECTED, DEFERRED, REFERRED_BACK');
            $table->text('decision_rationale')->nullable()->comment('Decision rationale');
            $table->integer('decision_votes_for')->default(0)->comment('Votes in favor');
            $table->integer('decision_votes_against')->default(0)->comment('Votes against');
            $table->integer('decision_votes_abstain')->default(0)->comment('Abstentions');
            $table->boolean('decision_chair_casting_vote')->default(false)->comment('Chair used casting vote');
            $table->json('decision_conditions')->nullable()->comment('License conditions if approved');
            $table->string('decision_status')->default('DRAFT')->comment('Status: DRAFT, FINAL');
            $table->timestamps();

            $table->foreign('decision_meeting_number')->references('msy_bilangan')->on('osc_smk_mesyuarat');
            $table->foreign('decision_agenda_item_id')->references('id')->on('meeting_agenda_items');
            $table->index(['decision_meeting_number', 'decision_application_reference'], 'meeting_decision_app_idx');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meeting_decisions');
    }
};
