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
        Schema::create('classrooms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('instructor_id')->constrained()->onDelete('cascade');
            $table->string('class_name'); 
            $table->string('section');
            $table->foreignId('subject_id')->constrained()->onDelete('cascade');
            $table->string('link')->nullable(); 
            $table->text('description')->nullable(); 
            $table->integer('capacity')->default(30); 
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->dateTime('schedule')->nullable(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classrooms');
    }
};
