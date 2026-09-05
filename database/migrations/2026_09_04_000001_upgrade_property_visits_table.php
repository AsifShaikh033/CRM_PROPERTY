<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // This repair is for installations that ran the original visit migration.
        // Fresh installations already receive this structure from that migration.
        if (Schema::hasColumn('property_visits', 'notes')) {
            $foreignKeys = DB::select(
                'SELECT CONSTRAINT_NAME FROM information_schema.TABLE_CONSTRAINTS
                 WHERE TABLE_SCHEMA = ? AND TABLE_NAME = ? AND CONSTRAINT_TYPE = ?',
                [DB::getDatabaseName(), 'property_visits', 'FOREIGN KEY']
            );

            foreach ($foreignKeys as $foreignKey) {
                DB::statement("ALTER TABLE `property_visits` DROP FOREIGN KEY `{$foreignKey->CONSTRAINT_NAME}`");
            }

            DB::table('property_visits')->where('status', 'scheduled')->update(['status' => 'Scheduled']);
            DB::table('property_visits')->where('status', 'completed')->update(['status' => 'Completed']);
            DB::table('property_visits')->where('status', 'cancelled')->update(['status' => 'Cancelled']);

            Schema::table('property_visits', function (Blueprint $table) {
                $table->renameColumn('notes', 'visit_notes');
                $table->unsignedBigInteger('agent_id')->nullable()->after('lead_id');
                $table->time('visit_time')->nullable()->after('visit_date');
            });

            DB::statement("ALTER TABLE `property_visits` MODIFY `lead_id` BIGINT UNSIGNED NOT NULL");
            DB::statement("ALTER TABLE `property_visits` MODIFY `visit_time` TIME NOT NULL");
            DB::statement("ALTER TABLE `property_visits` MODIFY `status` VARCHAR(50) NOT NULL DEFAULT 'Scheduled'");
        }
    }

    public function down(): void
    {
        // Intentionally left irreversible: restoring the prior schema would recreate
        // database foreign-key constraints, which this module must not use.
    }
};
