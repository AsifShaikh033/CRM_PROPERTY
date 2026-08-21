<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('bookings', function(Blueprint $table) {
            $table->id();
            $table->foreignId('property_id')->constrained()->cascadeOnDelete(); $table->foreignId('tenant_id')->nullable()->constrained()->nullOnDelete(); $table->date('booking_date'); $table->decimal('amount',15,2)->default(0); $table->string('status')->default('pending'); $table->text('notes')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('bookings'); }
};