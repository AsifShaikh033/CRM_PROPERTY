<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('leads', function(Blueprint $table) {
            $table->id();
            $table->string('lead_name');
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->unsignedBigInteger('interested_property')->nullable();
            $table->unsignedBigInteger('assigned_agent')->nullable();
            $table->string('lead_source')->nullable();
            $table->string('lead_status')->default('New');
            $table->date('next_follow_up_date')->nullable();
            $table->string('reminder')->nullable();
            $table->text('call_notes')->nullable();
            $table->string('follow_up_status')->default('Pending');
            $table->text('general_notes')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('leads'); }
};
