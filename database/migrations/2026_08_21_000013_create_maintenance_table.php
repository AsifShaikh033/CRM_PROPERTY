<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('maintenances', function(Blueprint $table) {
            $table->id();
            $table->foreignId('property_id')->constrained()->cascadeOnDelete(); $table->foreignId('unit_id')->nullable()->constrained('property_units')->nullOnDelete(); $table->foreignId('tenant_id')->nullable()->constrained()->nullOnDelete(); $table->string('title'); $table->text('description')->nullable(); $table->string('priority')->default('medium'); $table->string('status')->default('open'); $table->string('assigned_to')->nullable(); $table->dateTime('completed_at')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('maintenances'); }
};