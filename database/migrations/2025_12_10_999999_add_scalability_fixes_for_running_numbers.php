<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     * Add missing PBT code columns and extend VARCHAR lengths for scalability
     */
    public function up(): void
    {
        // 1. Add bil_kdsrpbt to bills table (if not exists)
        if (Schema::hasTable('osc_bil_bayaran') && !Schema::hasColumn('osc_bil_bayaran', 'bil_kdsrpbt')) {
            Schema::table('osc_bil_bayaran', function (Blueprint $table) {
                $table->string('bil_kdsrpbt', 10)->nullable()->after('bil_id')->comment('PBT code');
                $table->index('bil_kdsrpbt');
            });
        }

        // 2. Extend bil_nombor length (currently no explicit length, make it explicit)
        if (Schema::hasTable('osc_bil_bayaran') && Schema::hasColumn('osc_bil_bayaran', 'bil_nombor')) {
            Schema::table('osc_bil_bayaran', function (Blueprint $table) {
                $table->string('bil_nombor', 50)->nullable()->change();
            });
        }

        // 3. Extend msy_bilangan length for meetings (currently VARCHAR(10))
        if (Schema::hasTable('osc_smk_mesyuarat') && Schema::hasColumn('osc_smk_mesyuarat', 'msy_bilangan')) {
            Schema::table('osc_smk_mesyuarat', function (Blueprint $table) {
                $table->string('msy_bilangan', 50)->nullable()->change();
            });
        }

        // 4. Add msy_kdsrpbt to meetings table (missing PBT code column)
        if (Schema::hasTable('osc_smk_mesyuarat') && !Schema::hasColumn('osc_smk_mesyuarat', 'msy_kdsrpbt')) {
            Schema::table('osc_smk_mesyuarat', function (Blueprint $table) {
                $table->string('msy_kdsrpbt', 10)->nullable()->after('msy_bilangan')->comment('PBT code');
                $table->index('msy_kdsrpbt');
            });
        }

        // 5. Extend meeting-related foreign key columns for new format
        if (Schema::hasTable('meeting_agendas') && Schema::hasColumn('meeting_agendas', 'agenda_meeting_number')) {
            Schema::table('meeting_agendas', function (Blueprint $table) {
                $table->string('agenda_meeting_number', 50)->change();
            });
        }

        if (Schema::hasTable('meeting_attendees') && Schema::hasColumn('meeting_attendees', 'attendee_meeting_number')) {
            Schema::table('meeting_attendees', function (Blueprint $table) {
                $table->string('attendee_meeting_number', 50)->change();
            });
        }

        if (Schema::hasTable('meeting_minutes') && Schema::hasColumn('meeting_minutes', 'minute_meeting_number')) {
            Schema::table('meeting_minutes', function (Blueprint $table) {
                $table->string('minute_meeting_number', 50)->change();
            });
        }

        if (Schema::hasTable('meeting_decisions') && Schema::hasColumn('meeting_decisions', 'decision_meeting_number')) {
            Schema::table('meeting_decisions', function (Blueprint $table) {
                $table->string('decision_meeting_number', 50)->change();
            });
        }

        if (Schema::hasTable('meeting_agenda_items') && Schema::hasColumn('meeting_agenda_items', 'item_meeting_number')) {
            Schema::table('meeting_agenda_items', function (Blueprint $table) {
                $table->string('item_meeting_number', 50)->change();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('osc_bil_bayaran', function (Blueprint $table) {
            $table->dropColumn('bil_kdsrpbt');
            $table->string('bil_nombor')->change(); // Revert to default
        });

        Schema::table('osc_smk_mesyuarat', function (Blueprint $table) {
            $table->string('msy_bilangan', 10)->nullable(false)->change();
            if (Schema::hasColumn('osc_smk_mesyuarat', 'msy_kdsrpbt')) {
                $table->dropColumn('msy_kdsrpbt');
            }
        });

        // Revert meeting-related foreign key columns
        Schema::table('meeting_agendas', function (Blueprint $table) {
            $table->string('agenda_meeting_number', 10)->change();
        });

        Schema::table('meeting_attendees', function (Blueprint $table) {
            $table->string('attendee_meeting_number', 10)->change();
        });

        Schema::table('meeting_minutes', function (Blueprint $table) {
            $table->string('minute_meeting_number', 10)->change();
        });

        Schema::table('meeting_decisions', function (Blueprint $table) {
            $table->string('decision_meeting_number', 20)->change();
        });

        Schema::table('meeting_agenda_items', function (Blueprint $table) {
            $table->string('item_meeting_number', 10)->change();
        });
    }
};
