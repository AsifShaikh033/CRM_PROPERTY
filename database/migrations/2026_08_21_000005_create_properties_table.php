<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('properties', function(Blueprint $table) {
            $table->id();
            $table->string('name'); $table->string('property_code')->unique(); $table->foreignId('property_type_id')->constrained()->cascadeOnDelete(); $table->foreignId('owner_id')->nullable()->constrained()->nullOnDelete(); $table->string('phone')->nullable(); $table->string('email')->nullable(); $table->text('address')->nullable(); $table->string('city')->nullable(); $table->string('state')->nullable(); $table->string('country')->default('India'); $table->unsignedInteger('total_units')->default(1); $table->decimal('monthly_rent',15,2)->default(0); $table->enum('status',['active','draft','inactive'])->default('active'); $table->text('description')->nullable(); $table->json('amenities')->nullable(); $table->string('image')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('properties'); }
};