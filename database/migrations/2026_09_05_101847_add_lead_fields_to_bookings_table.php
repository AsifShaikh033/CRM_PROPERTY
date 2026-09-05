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
        Schema::table('bookings', function (Blueprint $table) {
            $table->unsignedBigInteger('lead_id')->nullable()->after('tenant_id');
            $table->string('lead_name')->nullable()->after('lead_id');
            $table->unsignedBigInteger('lead_interested_property')->nullable()->after('lead_name');
            $table->unsignedBigInteger('lead_assigned_agent')->nullable()->after('lead_interested_property');
            $table->string('lead_phone')->nullable()->after('lead_assigned_agent');
            $table->string('lead_lead_status')->nullable()->after('lead_phone');
            $table->string('lead_follow_up_status')->nullable()->after('lead_lead_status');
        });
    }

    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn([
                'lead_id',
                'lead_name',
                'lead_interested_property',
                'lead_assigned_agent',
                'lead_phone',
                'lead_lead_status',
                'lead_follow_up_status',
            ]);
        });
    }
};
