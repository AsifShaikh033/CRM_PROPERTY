<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('rent_payments', function(Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id')->constrained()->cascadeOnDelete(); $table->foreignId('property_id')->constrained()->cascadeOnDelete(); $table->foreignId('unit_id')->nullable()->constrained('property_units')->nullOnDelete(); $table->decimal('amount',15,2); $table->date('payment_date'); $table->unsignedTinyInteger('month'); $table->unsignedSmallInteger('year'); $table->string('method'); $table->string('status')->default('paid'); $table->string('reference')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('rent_payments'); }
};