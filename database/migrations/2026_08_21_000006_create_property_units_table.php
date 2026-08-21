<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('property_units', function(Blueprint $table) {
            $table->id();
            $table->foreignId('property_id')->constrained()->cascadeOnDelete(); $table->string('unit_number'); $table->string('unit_type')->nullable(); $table->decimal('rent',15,2)->default(0); $table->enum('status',['available','occupied','reserved','maintenance','blocked'])->default('available'); $table->foreignId('tenant_id')->nullable()->constrained()->nullOnDelete();
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('property_units'); }
};