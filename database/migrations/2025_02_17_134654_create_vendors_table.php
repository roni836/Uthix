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
        Schema::create('vendors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('mobile')->unique();
            $table->enum('gender', ['male', 'female', 'other']);
            $table->date('dob');
            $table->text('address');
            $table->string('store_name');
            $table->text('store_address');
            $table->string('logo')->nullable();
            $table->string('school')->nullable();
            $table->string('counter')->default(0);
            $table->string('status')->nullable();
            $table->boolean('isApproved')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendors');
    }
};
