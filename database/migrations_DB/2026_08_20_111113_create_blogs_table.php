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
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('title')->nullable();
            $table->string('slug')->unique();
            $table->string('image')->nullable();
            $table->string('short_description', 500)->nullable();
            $table->longText('description')->nullable();
            $table->string('author')->nullable();
            $table->integer('priority')->default(0);
            $table->boolean('status')->default(1);
            $table->date('published_at')->nullable();
            $table->string('meta_title')->nullable();
            $table->text('meta_keywords')->nullable();
            $table->text('meta_description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};
