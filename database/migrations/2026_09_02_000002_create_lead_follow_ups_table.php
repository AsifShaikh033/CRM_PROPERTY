<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('lead_follow_ups', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lead_id');
            $table->unsignedBigInteger('agent');
            $table->date('contact_date');
            $table->string('contact_method');
            $table->string('outcome');
            $table->string('next_action')->nullable();
            $table->date('next_follow_up_date')->nullable();
            $table->string('reminder')->nullable();
            $table->text('call_notes')->nullable();
            $table->timestamps();
            $table->index('lead_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lead_follow_ups');
    }
};
