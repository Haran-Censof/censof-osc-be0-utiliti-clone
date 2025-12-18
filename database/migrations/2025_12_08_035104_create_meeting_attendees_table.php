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
            $table->string('attendee_meeting_number', 10)->comment('Meeting number reference');
            $table->string('attendee_user_id')->comment('Internal user ID');
            $table->string('attendee_role')->default('MEMBER')->comment('Role: CHAIRPERSON, SECRETARY, MEMBER');
            $table->string('attendee_status')->default('INVITED')->comment('Status: INVITED, CONFIRMED, HADIR, ABSENT');
            $table->boolean('attendee_has_conflict')->default(false)->comment('Declaration of interest conflict');
            $table->text('attendee_conflict_reason')->nullable()->comment('Reason for conflict of interest');
            $table->timestamps();

            $table->foreign('attendee_meeting_number')->references('msy_bilangan')->on('osc_smk_mesyuarat');
            $table->foreign('attendee_user_id')->references('user_id')->on('osc_usr_profile');
            $table->unique(['attendee_meeting_number', 'attendee_user_id'], 'meeting_attendee_unique');
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
