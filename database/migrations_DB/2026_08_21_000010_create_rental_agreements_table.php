<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('rental_agreements', function(Blueprint $table) {
            $table->id();
            $table->foreignId('property_id')->constrained()->cascadeOnDelete(); $table->foreignId('unit_id')->nullable()->constrained('property_units')->nullOnDelete(); $table->foreignId('tenant_id')->constrained()->cascadeOnDelete(); $table->date('start_date'); $table->date('end_date')->nullable(); $table->decimal('rent',15,2); $table->decimal('deposit',15,2)->default(0); $table->string('status')->default('active');
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('rental_agreements'); }
};