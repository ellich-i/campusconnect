<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Function: runs whenever the trigger fires
        DB::unprepared("
        CREATE OR REPLACE FUNCTION log_event_status_change() RETURNS trigger AS \$\$
        BEGIN
            -- Only log when the status really changed
            IF NEW.status IS DISTINCT FROM OLD.status THEN
                INSERT INTO event_status_logs (event_id, old_status, new_status)
                VALUES (OLD.id, OLD.status, NEW.status);
            END IF;
            RETURN NEW;
        END;
        \$\$ LANGUAGE plpgsql;
    ");

        // Trigger: watches UPDATEs of the status column on events
        DB::unprepared('
        CREATE TRIGGER trg_event_status_log
        AFTER UPDATE OF status ON events
        FOR EACH ROW EXECUTE FUNCTION log_event_status_change();
    ');
    }

    public function down(): void
    {
        DB::unprepared('DROP TRIGGER IF EXISTS trg_event_status_log ON events');
        DB::unprepared('DROP FUNCTION IF EXISTS log_event_status_change()');
    }
};
