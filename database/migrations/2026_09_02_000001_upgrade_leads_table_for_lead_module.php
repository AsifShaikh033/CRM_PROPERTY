<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('leads', function (Blueprint $table) {
            $table->dropForeign(['property_id']);
            $table->dropColumn('property_id');
            $table->renameColumn('name', 'lead_name');
            $table->renameColumn('source', 'lead_source');
            $table->renameColumn('status', 'lead_status');
            $table->renameColumn('notes', 'general_notes');
            $table->unsignedBigInteger('interested_property')->nullable()->after('email');
            $table->unsignedBigInteger('assigned_agent')->nullable()->after('interested_property');
            $table->date('next_follow_up_date')->nullable()->after('lead_status');
            $table->string('reminder')->nullable()->after('next_follow_up_date');
            $table->text('call_notes')->nullable()->after('reminder');
            $table->string('follow_up_status')->default('Pending')->after('call_notes');
        });
    }

    public function down(): void
    {
        Schema::table('leads', function (Blueprint $table) {
            $table->dropColumn(['interested_property', 'assigned_agent', 'next_follow_up_date', 'reminder', 'call_notes', 'follow_up_status']);
            $table->renameColumn('lead_name', 'name');
            $table->renameColumn('lead_source', 'source');
            $table->renameColumn('lead_status', 'status');
            $table->renameColumn('general_notes', 'notes');
            $table->unsignedBigInteger('property_id')->nullable();
        });
    }
};
