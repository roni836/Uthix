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
        Schema::create('assignment_uploads', function (Blueprint $table) {
            $table->id();
    $table->foreignId('announcement_id')->constrained()->onDelete('cascade');
    $table->foreignId('student_id')->constrained('users')->onDelete('cascade');
    $table->foreignId('classroom_id')->constrained()->onDelete('cascade');
    $table->timestamp('submitted_at')->nullable();
    $table->enum('status', ['pending', 'graded', 'rejected'])->default('pending');
    $table->string('title')->nullable();
    $table->text('comment')->nullable();
    $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assignment_uploads');
    }
};
