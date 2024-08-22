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
        Schema::create('notes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('parent_id')->nullable()->constrained('notes')->onDelete('cascade');
            $table->foreignId('books')->constrained('books')->onDelete('cascade');
            $table->string('title', 50);
            $table->string('description', 200);
            $table->text('content'); 
            $table->integer('level');
            $table->integer('order');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notes');
    }
};
