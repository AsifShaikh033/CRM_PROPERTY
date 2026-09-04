<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('property_visits', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('property_id');
            $table->unsignedBigInteger('lead_id');
            $table->unsignedBigInteger('agent_id')->nullable();
            $table->date('visit_date');
            $table->time('visit_time');
            $table->string('status', 50)->default('Scheduled');
            $table->text('visit_notes')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('property_visits'); }
};
